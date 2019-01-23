$(document).ready(function(){
    $('#DocumentoProduto').submit(function(e) {
        e.preventDefault();
        var codigo = $('input[name="codigo"]').val();
        var documento_numero = $('input[name="documento_numero"]').val();
        $.ajax({
            url: 'src/ajax/createDocumentoProduto.php',
            type: 'POST',
            dataType: 'json',
            data: {codigo,documento_numero},
            beforeSend: function() {
                $('#sbmt_codigo').html('<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Aguarde');
            },
            success: function(response) {
                $('#sbmt_codigo').html('Ok');
                $('input[name="documento_numero"]').val(response.documentoNumero);

                if (response.status == "sucesso") {
                    $('#alert-DocumentoProduto').attr('class','alert alert-success');
                    $('#alert-DocumentoProduto').html('Produto incluso na venda.');
                    $('#alert-DocumentoProduto').show();
                    $('#product-table > tbody:last-child').append('<tr><th>' + response.ProdutoCodigo + '</th><th>' + response.ProdutoDescricao + '</th><th>R$' + response.ProdutoPreco +'</th></tr>');
                } else {
                    $('#alert-DocumentoProduto').attr('class','alert alert-danger');
                    if (response.status == "erro") {
                        $('#alert-DocumentoProduto').html('Produto não cadastrado.');
                    } else {
                        $('#alert-DocumentoProduto').html('Produto já consta na venda.');
                    }
                    $('#alert-DocumentoProduto').show();
                }
            },
            error: function() {
                $('#sbmt_codigo').html('Ok');
            }
        });
        return false;
    });
});