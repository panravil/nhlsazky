<?php

namespace App\Http\Controllers;

use App\barion\BarionClient;
use App\barion\common\BarionEnvironment;
use App\barion\common\Currency;
use App\barion\common\FundingSourceType;
use App\barion\common\PaymentType;
use App\barion\common\UILocale;
use App\barion\models\common\ItemModel;
use App\barion\models\payment\PaymentTransactionModel;
use App\barion\models\payment\PreparePaymentRequestModel;
use App\Event;
use App\FAQ;
use App\Match;
use App\Message;
use App\Redirect;
use App\Review;
use App\Section;
use App\Tariff;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $matches = Match::where([['show', '>', 0], ['start', '>', Carbon::now()->addHours(-10)]])->orderBy('start', 'ASC')->limit(12)->get();
        $reviews = Review::take(3)->get();
        $faqs = FAQ::take(5)->get();
        return view('clean.home.homePage', compact('matches', 'reviews', 'faqs'));
    }

    public function countdown()
    {
        $event = Event::where('seo', '=', 'sezonni-balicek')->first();
        return view('clean.pages.countdown', compact('event'));
    }


    public function odpocet()
    {
        $event = Event::where('seo', '=', 'sezonni-balicek')->first();
        return view('clean.pages.odpocet', compact('event'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contact()
    {
        return view('front.contact.contact');
    }


    public function sendContact(Request $request)
    {
        if (!empty($_POST['website'])) {
            Log::notice('BOT SPAM', ['ip' => $request->getClientIp(), 'email' => $request->get('email'), 'website' => $request->get('website')]);
            abort(404);
        };
        if (Auth::check()) {
            if (Auth::user()->email != $request->get('email')) {
                Log::alert('BOT SPAM', ['ip' => $request->getClientIp(), 'email' => $request->get('email'), 'user' => Auth::id()]);
                abort(404);
            }
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'text' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'text' => 'required',
                'captcha' => 'required|captcha',
            ]);
        }
        try {
            $contact = new Message([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'text' => $request->get('text'),
            ]);
            $actionURL = url(route('admin.uzivatele.index', ['search' => $contact->email]));
            if (Auth::check()) {
                $contact->user_id = Auth::user()->id;
                $actionURL = url(route('admin.uzivatele.show', Auth::user()->id));
                Log::info('Zprava od ' . $request->get('email'), ['id' => Auth::user()->id, 'ip' => $request->ip()]);
            } else {
                Log::info('Zprava od ' . $request->get('email'), ['ip' => $request->ip()]);
            }
            $contact->save();
            $details = [
                'subject' => 'Kontaktní formulář',
                'name' => $contact->name,
                'email' => $contact->email,
                'text' => $contact->text,
                'actionURL' => $actionURL
            ];
            return back()->with('success', 'Odesláno!');
        } catch (\Exception $e) {
            Log::warning('Zprava od ' . $request->get('email') . $e->getMessage());
            return back()->with('error', 'Bohužél se něco nepovedlo. Zkuste to prosím znovu později.');
        }
    }


    function is_bot()
    {

        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            return preg_match('/rambler|abacho|acoi|accona|aspseek|altavista|estyle|scrubby|lycos|geona|ia_archiver|alexa|sogou|skype|facebook|twitter|pinterest|linkedin|naver|bing|google|yahoo|duckduckgo|yandex|baidu|teoma|xing|java\/1.7.0_45|bot|crawl|slurp|spider|mediapartners|\sask\s|\saol\s/i', $_SERVER['HTTP_USER_AGENT']);
        }

        return true;
    }


    public function preparePaymentRequest($tarif, $currency)
    {
        try {
            $item = new ItemModel();
            $item->Name = $tarif->title;
            $item->Description = $tarif->title;
            $item->Quantity = 1;
            $item->Unit = "piece";
            $item->UnitPrice = $currency == 'eur' ? $tarif->priceEUR : $tarif->priceCZK;
            $item->ItemTotal = $currency == 'eur' ? $tarif->priceEUR : $tarif->priceCZK;
            $item->SKU = $tarif->seo;
            $trans = new PaymentTransactionModel();
            $trans->POSTransactionId = "TRANS-01";
            $trans->Payee = "roman.danko@email.cz";
            $trans->Total = $item->ItemTotal;
            $trans->Currency = $currency == 'eur' ? $tarif->priceEUR : $tarif->priceCZK;
            $trans->Comment = "Platba za premium";
            $trans->AddItem($item);
            if (Auth::user()) {
                $uziv_email = Auth::user()->email;
            } else {
                $uziv_email = 'null';
            }
            $payReq = new PreparePaymentRequestModel();
            $payReq->GuestCheckout = true;
            $payReq->PaymentType = PaymentType::Immediate;
            $payReq->FundingSources = array(FundingSourceType::All);
            $payReq->PaymentRequestId = "PAYMENT-01";
            $payReq->PayerHint = $uziv_email;
            $payReq->PayerPhoneNumber = "7776665555";
            $payReq->Locale = $currency == 'eur' ? UILocale::SK : UILocale::CZ;
            $payReq->OrderNumber = "ORDER-0001";
            $payReq->Currency = $currency == 'eur' ? Currency::EUR : Currency::CZK;
            $payReq->RedirectUrl = "https://nhlsazeni.cz/";
            $payReq->CallbackUrl = "https://nhlsazeni.cz/platba/callback";
            $payReq->AddTransaction($trans);
            return $payReq;
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function platba($tarif, $curr = 'czk')
    {
        $myPosKey = "81ee4ed1aba54772a48365a58b7c698c"; // <-- Replace this with your POSKey!
        $myEmailAddress = "roman.danko@email.cz";
        $BC = new BarionClient($myPosKey, 2, BarionEnvironment::Prod);
        $t = Tariff::where([['seo', $tarif], ['show', '=', 1]])->orWhere([['seo', $tarif], ['start', '<=', date('Y-m-d')], ['end', '>=', date('Y-m-d')]])->firstOrFail();

        $payReq = $this->preparePaymentRequest($t, $curr);
        $myPayment = $BC->PreparePayment($payReq);
        if ($myPayment->Status === 'Prepared') {
            if (Auth::user()) {
                $email = Auth::user()->email;
            } else {
                $email = null;
            }
            Transaction::create([
                'payment_id' => $myPayment->PaymentId, 'tariff_id' => $t->id, 'status' => 'Prepared', 'priceCZK' => $t->priceCZK, 'priceEUR' => $t->priceEUR, 'user_email' => $email
            ]);
            return redirect(url('https://barion.com/Pay?id=' . $myPayment->PaymentId));
        } else {
            return redirect(url("https://nhlsazeni.cz/nova-sezona"));
        }

        return redirect(url('https://barion.com/Pay?id=' . $myPayment->PaymentId));
    }

    public function event($name)
    {
        if ($page = Event::where([['show', '=', 1], ['seo', '=', $name]])->orWhere([['seo', '=', $name], ['from', '<=', date('Y-m-d')], ['to', '>=', date('Y-m-d')]])->first()) {

            return view('front.page.page', compact('page'));
        } else {

        }
    }

    public function about()
    {
        $page = Section::findOrFail(1);
        return view('front.page.page', compact('page'));
    }

    public function test()
    {
        return view('clean.layouts.test');
    }

    public function terms()
    {
        $page = Section::findOrFail(3);
        return view('front.page.page', compact('page'));
    }

    public function stream(Match $match)
    {
        return view('front.match.stream', compact('match'));
    }


    public function faq()
    {
        $page = Section::findOrFail(4);
        return view('clean.faq.index', compact('page'));
    }


    public function dictionary()
    {
        $page = Section::findOrFail(10);
        return view('front.page.page', compact('page'));
    }

    public function account()
    {

        return view('front.account.account');
    }

    public function proxy(Request $request)
    {
        $strFile = $request->get('url')[0];
        $array = explode('.', $strFile);
        $strFileExt = end($array);
        if ($strFileExt == 'jpg' or $strFileExt == 'jpeg') {
            header('Content-Type: image/jpeg');
        } elseif ($strFileExt == 'png') {
            header('Content-Type: image/png');
        } elseif ($strFileExt == 'gif') {
            header('Content-Type: image/gif');
        } else {
            die('not supported');
        }
        if ($strFile != '') {
            $cache_ends = 60 * 60 * 24 * 365;
            header("Pragma: public");
            header("Cache-Control: maxage=" . $cache_ends);
            header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $cache_ends) . ' GMT');

            $img = file_get_contents($strFile);
            echo $img;
        }
        exit;
    }


    public function redirect($slug)
    {
        $page = Redirect::where('seo', '=', $slug)->first();
        if ($page) {
            if ($this->is_bot()) {
                if ($page->img) {
                    return view('front.layouts.redirectPage', compact('page'));
                } else {
                    return redirect(url($page->url));
                }
            } else {
                return redirect(url($page->url));
            }
        } else {
            return redirect(route('home'));
        }
    }

    public function premium()
    {
        if (!Auth::user()) {

            $page = Section::findOrFail(5);
            return view('front.premium.guest', compact('page'));
        }
        if (\Illuminate\Support\Facades\Auth::user()->subscriptionsValid->isEmpty() > 0) {
            $page = Section::findOrFail(5);
            return view('front.premium.guest', compact('page'));
        } else {
            $user = Auth::user();
            $tickets = $user->ticketsAvalible();
            return view('front.premium.premium')->with('tickets', $tickets);
        }
    }
}
