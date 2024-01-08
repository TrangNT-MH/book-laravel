<div class="col-lg-6 mx-auto">
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('user.checkEmailCode') }}">
                @csrf
                <div class="mb-3">
                    <label class="small mb-1" for="inputCode">Code verify</label>
                    <input class="form-control" id="inputCode" type="text" name="code" value="">
                    <input type="submit" hidden/>
                </div>
            </form>
        </div>
    </div>
</div>
