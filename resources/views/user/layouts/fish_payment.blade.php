<div id="box_fish" class="mb-2" style="display: none">

    @if(isset($cardbank_user))
        <div class="col-md-12 p-0 form-group mb-1">
            <label for="fish_transaction_number">شماره کارت واریزی</label>
            <input type="text" class="form-control numbers round text-center" value="{{$admin_card}}" disabled readonly>
        </div>
    @endif

    <div class="col-md-12 p-0 form-group mb-1">
        <label for="fish_transaction_number">شماره پیگیری</label>
        <input type="text" class="form-control numbers round text-center ltr-dir"
               id="fish_transaction_number" name="fish_transaction_number" maxlength="50"
               placeholder="شماره تراکنش" disabled>
        <div class="invalid-feedback">شماره تراکنش را درج کنید</div>
    </div>

    <div class="col-md-12 p-0 form-group mb-1">
        <label for="fish_transaction_number">تاریخ واریز</label>
        <input type="text" class="form-control round text-center ltr-dir"
               id="fish_transaction_date" name="fish_transaction_date" maxlength="50"
               placeholder="تاریخ تراکنش"  disabled>
        <div class="invalid-feedback">تاریخ تراکنش را درج کنید</div>
    </div>

    <div class="col-md-12 p-0 form-group mb-1">
        <label for="fish_transaction_number">مبلغ واریز</label>
        <input type="text" class="form-control round text-center ltr-dir"
               id="fish_transaction_amount" name="fish_transaction_amount" maxlength="30"
               placeholder="مبلغ تراکنش"  disabled>
        <div class="invalid-feedback">مبلغ تراکنش را درج کنید</div>
    </div>
    <div class="col-md-12 p-0 form-group mb-1">
        <label for="phone">توضیحات تراکنش(اختیاری)</label>
        <textarea rows="3" maxlength="300" id="fish_transaction_description" name="fish_transaction_description"
                  class="form-control round text-center"></textarea>
    </div>
    <div class="col-md-12 p-0 form-group">
        <label for="phone"> انتخاب کارت یا حساب مبدا</label>
        <select class="form-control round" name="fish_cardbank" id="fish_cadrbank" >
            <option value="" required disabled selected="">لطفا یکی از کارت های خود را انتخاب کنید</option>
            @foreach($cardbank_user as $card)
                <option value="{{$card->id}}">{{$card->card_number}}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">حساب مبدا را انتخاب کنید </div>

    </div>
</div>