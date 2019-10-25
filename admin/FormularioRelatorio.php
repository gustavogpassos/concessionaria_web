<?php
include ("ConectaAdmin.php");
include ("BancoAnuncio.php");


//verifica qual menu apresenter ao usuário
if (adminEstaLogado()) {
    include ("cabecalhoAdmin.php");
} else {
    include ("./headerUnlogado.php");
}
//verifica se o usuário pode ter acesso ao conteúdo
if (!adminEstaLogado()) {
    include ("./naoLogadoAdmin.php");
} else {
    ?>
    <form action="GeraRelatorio.php" method="post">
        <table class="table table-striped table-bordered">
            <tr>
                <td>
                    Período:
                </td>
                <td>
                    <input type="radio" name="dias" value="algum" required="">Ultimos:
                    <select name="quantosDias">
                        <option value="7">7</option>
                        <option value="14">14</option>
                        <option value="30">30</option>
                    </select>
                    dias.<br>

                    <input type="radio" name="dias" value="tudo" required="">Tudo
                </td>
            </tr>
            <tr>
                <td>
                    Informações sobre:
                </td>
                <td>
                    <input type="radio" name="tabela" value="usuarios" required="">Usuarios cadastrados<br>

                    <input type="radio" name="tabela" value="anuncios" required="">Anuncios publicados
                </td>
            </tr>
            <tr>
                <td class="left" colspan="2">
                    <input type="submit" class="btn btn-primary" value="Gerar Relatório">
                    <input type="reset" class="btn btn-default" value="Cancelar">
                </td>
            </tr>
        </table>
    </form>


    <?php
}
include ("../Rodape.php");
