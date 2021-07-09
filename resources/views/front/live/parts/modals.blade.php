<div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel" style="padding: 0">New message</h4>
            </div>
            <div class="modal-body">
                <form method="POST" id="form-tiket">

                    <div class="form-group">
                        {{ Form::label('match_id', 'Zápas') }}
                        {{ Form::select('match_id', \App\Match::where([['show', '>', 0], ['start', '>', \Carbon\Carbon::now()->addHours(-3)], ['start', '<', \Carbon\Carbon::now()->addHours(3)]])->orderBy('start', 'asc')->get()->pluck('full_label', 'id'), '', ['class' => 'form-control', 'placeholder' => 'Zápas']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('tip', 'Tip') }}
                        <input type="text" class="form-control" name="tip" placeholder="Tip" value=""
                               maxlength="200" autocomplete="off">
                    </div>
                    <div class="form-group">
                        {{ Form::label('cost', 'Vklad') }}
                        <input type="number" class="col-6 form-control" name="cost" placeholder="Vklad" value=""
                               step="0.01" autocomplete="off">
                    </div>

                    <div class="form-group">
                        {{ Form::label('odds', 'Kurz') }}
                        <input type="number" class="col-6 form-control" name="odds" placeholder="Kurz" value=""
                               maxlength="10" autocomplete="off">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Zavřít</button>
                <button type="button" class="btn btn-primary">Přidat tiket</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="topbarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel" style="padding: 0">Upozornění</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Text do topbar:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="control-label">Text do emailu:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Uložit/Odeslat</button>
            </div>
        </div>
    </div>
</div>
