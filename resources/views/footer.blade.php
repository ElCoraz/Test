        <footer>
            <div class="d-flex align-items-center justify-content-center" style="width: 100%;">
                <div class="p-2 bd-highlight">
                    Copyright @ {{date("Y")}}
                </div>
            </div>

        </footer>
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="messageBoxError">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="title_res" class="modal-title">Ошибка</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="message"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="messageBoxAdd">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="title" class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Наименование</label>
                            <input type="text" class="form-control" id="name" placeholder="Введите наименование">
                            <small id="name_error" class="text-danger">Введите не более 200 символов</small>
                        </div>
                        <div class="form-group">
                            <label for="price">Цена</label>
                            <input type="number" class="form-control" id="price" placeholder="Цена">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="description">Описание</label>
                                    <textarea class="form-control" id="description" rows="10" placeholder="Введите описание"></textarea>
                                    <small id="description_error" class="text-danger">Введите не более 1000 символов</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="image">Изображения</label>
                                    <textarea class="form-control" id="image" rows="10" placeholder="Введите ссылки на изображения"></textarea>
                                    <small id="image_error">Вводите ссылки через точку с запятой, не более 3 ссылок</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="close">Добавить</button>
                    </div>
                </div>
            </div>
        </div>
        </body>
        <script src="/js/jquery-3.6.0.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/app.js"></script>

        </html>