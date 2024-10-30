<form action="{{route('comment.store', ['product'=>$product])}}" method="post">
    @csrf
    <div class="form-body p-3">
        <h4 class="mb-4">Оставить отзыв</h4>
        <div class="mb-3">
            <label class="form-label">Имя</label>
            <input name="name" type="text" class="form-control rounded-0" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="text" class="form-control rounded-0">
        </div>
        <div class="mb-3">
            <label class="form-label">Оценка</label>
            <select name="rating" class="form-select rounded-0">
                <option selected>Оцените товар</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="3">4</option>
                <option value="3">5</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Оставте отзыв</label>
            <textarea name="body" class="form-control rounded-0" rows="3"></textarea>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-light btn-ecomm send_comment" >Отправить</button>
        </div>
    </div>
</form>
