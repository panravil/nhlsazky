<?php

namespace App\LaravelMailDriver;

use App\LaravelMailDriver\Transport\MailTransport;
use App\LaravelMailDriver\Transport\SimpleMailInvoker;
use Illuminate\Mail\MailServiceProvider as BaseMailServiceProvider;

class MailServiceProvider extends BaseMailServiceProvider
{
    /**
     * Extended register the Swift Transport instance.
     *
     * @return void
     */
    protected function registerSwiftTransport()
    {

        \Swift_DependencyContainer::getInstance()
            ->register('transport.mail')
            ->asNewInstanceOf(MailTransport::class)
            ->withDependencies(array('transport.mailinvoker', 'transport.eventdispatcher'))

            ->register('transport.mailinvoker')
            ->asSharedInstanceOf(SimpleMailInvoker::class);

        $this->app->singleton('swift.transport', function () {
            return new TransportManager($this->app);
        });
    }
}
