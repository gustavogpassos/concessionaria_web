<?php

include ("ConectaAdmin.php");
include ("BancoRelatorio.php");
include ("../usuario/BancoUsuario.php");

date_default_timezone_set('America/Sao_Paulo');

if ($_POST["dias"] === "tudo" && $_POST["tabela"] === "anuncios") {




//$filtro = $_POST["filtro"];

    if (array_key_exists("filtro", $_POST)) {
        $filtro = $_POST["filtro"];
    }

//$ordem = $_POST["filtro"];
    if (array_key_exists("ordem", $_POST)) {
        $ordem = $_POST["ordem"];
    }




// Endereço da biblioteca FPDF:
    $end_fpdf = "fpdf/";

// Número de resultados por página
    $por_pagina = 25;

//armazena a data em que foi criado o arquivo
    $dataPDF = date('d-m-Y');


// Endereço onde vai ser gerado o pdf com a data:
    $nome_pdf = "pdf/relacaoAnuncios$dataPDF.pdf";


    $titulo = "Lista de Anuncios";

// Tipo de PDF gerado: F-> Salva no endereço especificado na var $nome_pdf
    $tipo_pdf = "F";

// SQL

    $produtos = selectRelatorioAnuncio($conexao, NULL);
    $row = count($produtos);

// Verifica se retornou alguma linha:
    if (!$row) {
        echo "Não retornou nenhum registro";
        die;
    }

// Calcula quantas páginas serão necessárias:
    $paginas = ceil($row / $por_pagina);

// Prepara para gerar o pdf
    define("FPDF_FONTPATH", "$end_fpdf/font/");
    require_once("$end_fpdf/fpdf.php");
    $pdf = new FPDF();

// Inicializa variáveis de controle:
    $linha_atual = 0;
    $inicio = 0;

// Cria as páginas:
    for ($x = 1; $x <= $paginas; $x++) {

        $inicio = $linha_atual;
        $fim = $linha_atual + $por_pagina;
        if ($fim > $row)
            $fim = $row;

        $pdf->Open();
        $pdf->AddPage();

        //$pdf->Image($imagem, 10, 8);

        $pdf->SetFont("Arial", "B", 10);
        $pdf->Cell(85, 8, $dataPDF, 0, 0, 'L');
        $pdf->Cell(85, 8, "Pg $x de $paginas", 0, 0, 'R');
        $pdf->Ln(10);

        $pdf->SetFont("Arial", "B", 20);
        $pdf->Cell(185, 8, $titulo, 0, 0, 'C');
        $pdf->Ln(10);

        // Monta o cabeçalho:
        $pdf->SetFont("Arial", "B", 12);
        $pdf->Cell(15, 8, "ID", 1, 0, 'C');
        $pdf->Cell(50, 8, "Nome", 1, 0, 'L');
        $pdf->Cell(50, 8, "Preco", 1, 0, 'R');
        $pdf->Cell(40, 8, "Usuario", 1, 0, 'L');
        $pdf->Cell(30, 8, "Data", 1, 1, 'R');


        $pdf->SetFont("Arial", "B", 10);
        // Monta os registros:
        foreach ($produtos as $produto) {
            $id = $produto['id'];
            $nome = $produto['nome'];
            $preco = $produto['preco'];
            $preco = 'R$ ' . number_format($preco, 3, '.', ',');

            $user = $produto['nomeuser'] . " " . $produto['sobrenome'];
            $data = $produto['data'];




            $pdf->Cell(15, 8, $id, 1, 0, 'C');
            $pdf->Cell(50, 8, $nome, 1, 0, 'L');
            $pdf->Cell(50, 8, $preco, 1, 0, 'R');
            $pdf->Cell(40, 8, $user, 1, 0, 'L');
            $pdf->Cell(30, 8, $data, 1, 1, 'R');
            $linha_atual++;
        }
    }

// Gravação do PDF:
    $pdf->Output("$nome_pdf", "$tipo_pdf");

// Mostrar o link do PDF:
//echo "<a target='_blank' href='{$nome_pdf}'>Relatório gerado</a> ";
// Mostrar o conteúdo do PDF:
    header("Location: {$nome_pdf}");


// Download do PDF:
//header('Content-Length: ' . filesize($nome_pdf));
//header('Content-Type: application/pdf');
//header('Content-Disposition: attachment; filename=' . $nome_pdf);
//readfile($nome_pdf);


    die();
}



if ($_POST["dias"] === "tudo" && $_POST["tabela"] === "usuarios") {




//$filtro = $_POST["filtro"];

    if (array_key_exists("filtro", $_POST)) {
        $filtro = $_POST["filtro"];
    }

//$ordem = $_POST["filtro"];
    if (array_key_exists("ordem", $_POST)) {
        $ordem = $_POST["ordem"];
    }




// Endereço da biblioteca FPDF:
    $end_fpdf = "fpdf/";

// Número de resultados por página
    $por_pagina = 15;
    $dataPDF = date('d-m-Y');


// Endereço onde vai ser gerado o pdf:
    $nome_pdf = "pdf/relacaoUsuarios$dataPDF.pdf";

    $titulo = "Lista de Usuarios";

// Tipo de PDF gerado: F-> Salva no endereço especificado na var $nome_pdf
    $tipo_pdf = "F";



// SQL

    $usuarios = selectRelatorioUsuario($conexao, NULL);
    $row = count($usuarios);

// Verifica se retornou alguma linha:
    if (!$row) {
        echo "Não retornou nenhum registro";
        die;
    }

// Calcula quantas páginas serão necessárias:
    $paginas = ceil($row / $por_pagina);

// Prepara para gerar o pdf
    define("FPDF_FONTPATH", "$end_fpdf/font/");
    require_once("$end_fpdf/fpdf.php");
    $pdf = new FPDF();

// Inicializa variáveis de controle:
    $linha_atual = 0;
    $inicio = 0;

// Cria as páginas:
    for ($x = 1; $x <= $paginas; $x++) {

        $inicio = $linha_atual;
        $fim = $linha_atual + $por_pagina;
        if ($fim > $row)
            $fim = $row;

        $pdf->Open();
        $pdf->AddPage();

        //$pdf->Image($imagem, 10, 8);

        $pdf->SetFont("Arial", "B", 10);
        $pdf->Cell(85, 8, $dataPDF, 0, 0, 'L');
        $pdf->Cell(85, 8, "Pg $x de $paginas", 0, 0, 'R');
        $pdf->Ln(10);

        $pdf->SetFont("Arial", "B", 20);
        $pdf->Cell(185, 8, $titulo, 0, 0, 'C');
        $pdf->Ln(10);

        // Monta o cabeçalho:
        $pdf->SetFont("Arial", "B", 12);
        $pdf->Cell(15, 8, "ID", 1, 0, 'C');
        $pdf->Cell(50, 8, "Nome", 1, 0, 'L');
        $pdf->Cell(70, 8, "Email", 1, 0, 'R');
        $pdf->Cell(30, 8, "Data", 1, 1, 'R');


        $pdf->SetFont("Arial", "B", 10);
        // Monta os registros:
        foreach ($usuarios as $usuario) {
            $id = $usuario['id'];
            $nome = $usuario['nomeuser'];
            $sobrenome = $usuario['sobrenome'];
            $nome = $nome . " " . $sobrenome;
            $email = $usuario['email'];
            $data = $usuario['datacad'];


            $pdf->Cell(15, 8, $id, 1, 0, 'C');
            $pdf->Cell(50, 8, $nome, 1, 0, 'L');
            $pdf->Cell(70, 8, $email, 1, 0, 'R');
            $pdf->Cell(30, 8, $data, 1, 1, 'R');
            $linha_atual++;
        }
    }

// Gravação do PDF:
    $pdf->Output("$nome_pdf", "$tipo_pdf");

// Mostrar o link do PDF:
//echo "<a target='_blank' href='{$nome_pdf}'>Relatório gerado</a> ";
// Mostrar o conteúdo do PDF:
    header("Location: {$nome_pdf}");
    die();

// Download do PDF:
//header('Content-Length: ' . filesize($nome_pdf));
//header('Content-Type: application/pdf');
//header('Content-Disposition: attachment; filename=' . $nome_pdf);
//readfile($nome_pdf);
}




if ($_POST["dias"] === "algum" && $_POST["tabela"] === "anuncios") {




//$filtro = $_POST["filtro"];

    if (array_key_exists("filtro", $_POST)) {
        $filtro = $_POST["filtro"];
    }

//$ordem = $_POST["filtro"];
    if (array_key_exists("ordem", $_POST)) {
        $ordem = $_POST["ordem"];
    }




// Endereço da biblioteca FPDF:
    $end_fpdf = "fpdf/";

// Número de resultados por página
    $por_pagina = 25;

//armazena a data em que foi criado o arquivo
    $dataPDF = date('d-m-Y');


// Endereço onde vai ser gerado o pdf com a data:
    $nome_pdf = "pdf/relacaoAnuncios$dataPDF.pdf";


    $titulo = "Lista de Anuncios";

// Tipo de PDF gerado: F-> Salva no endereço especificado na var $nome_pdf
    $tipo_pdf = "F";

// SQL
    $dias = $_POST['quantosDias'];
    $produtos = selectRelatorioAnuncio($conexao, $dias);
    $row = count($produtos);

// Verifica se retornou alguma linha:
    if (!$row) {
        echo "Não retornou nenhum registro";
        die;
    }

// Calcula quantas páginas serão necessárias:
    $paginas = ceil($row / $por_pagina);

// Prepara para gerar o pdf
    define("FPDF_FONTPATH", "$end_fpdf/font/");
    require_once("$end_fpdf/fpdf.php");
    $pdf = new FPDF();

// Inicializa variáveis de controle:
    $linha_atual = 0;
    $inicio = 0;

// Cria as páginas:
    for ($x = 1; $x <= $paginas; $x++) {

        $inicio = $linha_atual;
        $fim = $linha_atual + $por_pagina;
        if ($fim > $row)
            $fim = $row;

        $pdf->Open();
        $pdf->AddPage();

        //$pdf->Image($imagem, 10, 8);

        $pdf->SetFont("Arial", "B", 10);
        $pdf->Cell(85, 8, $dataPDF, 0, 0, 'L');
        $pdf->Cell(85, 8, "Pg $x de $paginas", 0, 0, 'R');
        $pdf->Ln(10);

        $pdf->SetFont("Arial", "B", 20);
        $pdf->Cell(185, 8, $titulo, 0, 0, 'C');
        $pdf->Ln(10);

        // Monta o cabeçalho:
        $pdf->SetFont("Arial", "B", 12);
        $pdf->Cell(15, 8, "ID", 1, 0, 'C');
        $pdf->Cell(50, 8, "Nome", 1, 0, 'L');
        $pdf->Cell(50, 8, "Preco", 1, 0, 'R');
        $pdf->Cell(40, 8, "usuario", 1, 0, 'L');
        $pdf->Cell(30, 8, "Data", 1, 1, 'R');


        $pdf->SetFont("Arial", "B", 10);
        // Monta os registros:
        foreach ($produtos as $produto) {
            $id = $produto['id'];
            $nome = $produto['nome'];
            $preco = $produto['preco'];
            $preco = 'R$ ' . number_format($preco, 3, '.', ',');

            $user = $produto['nomeuser'] . " " . $produto['sobrenome'];
            $data = $produto['data'];




            $pdf->Cell(15, 8, $id, 1, 0, 'C');
            $pdf->Cell(50, 8, $nome, 1, 0, 'L');
            $pdf->Cell(50, 8, $preco, 1, 0, 'R');
            $pdf->Cell(40, 8, $user, 1, 0, 'L');
            $pdf->Cell(30, 8, $data, 1, 1, 'R');
            $linha_atual++;
        }
    }

// Gravação do PDF:
    $pdf->Output("$nome_pdf", "$tipo_pdf");

// Mostrar o link do PDF:
//echo "<a target='_blank' href='{$nome_pdf}'>Relatório gerado</a> ";
// Mostrar o conteúdo do PDF:
    header("Location: {$nome_pdf}");


// Download do PDF:
//header('Content-Length: ' . filesize($nome_pdf));
//header('Content-Type: application/pdf');
//header('Content-Disposition: attachment; filename=' . $nome_pdf);
//readfile($nome_pdf);


    die();
}






if ($_POST["dias"] === "algum" && $_POST["tabela"] === "usuarios") {




//$filtro = $_POST["filtro"];

    if (array_key_exists("filtro", $_POST)) {
        $filtro = $_POST["filtro"];
    }

//$ordem = $_POST["filtro"];
    if (array_key_exists("ordem", $_POST)) {
        $ordem = $_POST["ordem"];
    }




// Endereço da biblioteca FPDF:
    $end_fpdf = "fpdf/";

// Número de resultados por página
    $por_pagina = 15;
    $dataPDF = date('d-m-Y');


// Endereço onde vai ser gerado o pdf:
    $nome_pdf = "pdf/relacaoUsuarios$dataPDF.pdf";

    $titulo = "Lista de Usuarios";

// Tipo de PDF gerado: F-> Salva no endereço especificado na var $nome_pdf
    $tipo_pdf = "F";



// SQL
    $dias = $_POST['quantosDias'];
    $usuarios = selectRelatorioUsuario($conexao, $dias);
    $row = count($usuarios);

// Verifica se retornou alguma linha:
    if (!$row) {
        echo "Não retornou nenhum registro";
        die;
    }

// Calcula quantas páginas serão necessárias:
    $paginas = ceil($row / $por_pagina);

// Prepara para gerar o pdf
    define("FPDF_FONTPATH", "$end_fpdf/font/");
    require_once("$end_fpdf/fpdf.php");
    $pdf = new FPDF();

// Inicializa variáveis de controle:
    $linha_atual = 0;
    $inicio = 0;

// Cria as páginas:
    for ($x = 1; $x <= $paginas; $x++) {

        $inicio = $linha_atual;
        $fim = $linha_atual + $por_pagina;
        if ($fim > $row)
            $fim = $row;

        $pdf->Open();
        $pdf->AddPage();

        //$pdf->Image($imagem, 10, 8);

        $pdf->SetFont("Arial", "B", 10);
        $pdf->Cell(85, 8, $dataPDF, 0, 0, 'L');
        $pdf->Cell(85, 8, "Pg $x de $paginas", 0, 0, 'R');
        $pdf->Ln(10);

        $pdf->SetFont("Arial", "B", 20);
        $pdf->Cell(185, 8, $titulo, 0, 0, 'C');
        $pdf->Ln(10);

        // Monta o cabeçalho:
        $pdf->SetFont("Arial", "B", 12);
        $pdf->Cell(15, 8, "ID", 1, 0, 'C');
        $pdf->Cell(50, 8, "Nome", 1, 0, 'L');
        $pdf->Cell(80, 8, "Email", 1, 0, 'R');
        $pdf->Cell(30, 8, "Data", 1, 1, 'R');


        $pdf->SetFont("Arial", "B", 10);
        // Monta os registros:
        foreach ($usuarios as $usuario) {
            $id = $usuario['id'];
            $nome = $usuario['nomeuser'];
            $sobrenome = $usuario['sobrenome'];
            $nome = $nome . " " . $sobrenome;
            $email = $usuario['email'];
            $data = $usuario['datacad'];


            $pdf->Cell(15, 8, $id, 1, 0, 'C');
            $pdf->Cell(50, 8, $nome, 1, 0, 'L');
            $pdf->Cell(80, 8, $email, 1, 0, 'R');
            $pdf->Cell(30, 8, $data, 1, 1, 'R');
            $linha_atual++;
        }
    }

// Gravação do PDF:
    $pdf->Output("$nome_pdf", "$tipo_pdf");

// Mostrar o link do PDF:
//echo "<a target='_blank' href='{$nome_pdf}'>Relatório gerado</a> ";
// Mostrar o conteúdo do PDF:
    header("Location: {$nome_pdf}");
    die();

// Download do PDF:
//header('Content-Length: ' . filesize($nome_pdf));
//header('Content-Type: application/pdf');
//header('Content-Disposition: attachment; filename=' . $nome_pdf);
//readfile($nome_pdf);
}


