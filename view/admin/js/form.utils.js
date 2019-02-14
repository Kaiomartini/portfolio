
    function excluir(page, callback, id) {
        swal({
            title: 'Tem certeza?',
            text: "Essa ação é irreversível!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, apagar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            $.ajax({
                type: "POST",
                url: page,
                data: {
                    codigo: id,
                    excluir: ''
                },
                beforeSend: function () {
                    $("main").fadeTo("slow", 0.2);
                    Pace.restart();
                },
                success: function (data) {
                    $("main").html(data);
                    //window.history.pushState("", "", callback);
                },
                error: function (erro) {
                    makeErrorMessage("Não foi possível excluir cadastro.")
                },
                complete: function () {
                    Pace.stop();
                    $("main").fadeTo("fast", 1);
                }
            });
        })
    };

    function novo(page, callback) {
        $.ajax({
            type: "GET",
            url: page,
            data: {},
            beforeSend: function () {
                $("main").fadeTo("slow", 0.2);
                Pace.restart();
            },
            success: function (data) {
                $("main").html(data);
                window.history.pushState("", "", callback);
            },
            error: function (erro) {
                makeErrorMessage("Não foi possível abrir novo cadastro.")
            },
            complete: function () {
                Pace.stop();
                $("main").fadeTo("fast", 1);
            }
        });
    }
