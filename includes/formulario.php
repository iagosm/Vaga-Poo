<main>

<section>
    <a href="index.php">
        <button class="btn btn-success" style="margin-top: 20px;">Voltar</button>
    </a>
</section>
<h2 class="mt-3"><?= TITLE?></h2>
<form action="" method="post">
<div class="form-group">
    <label for="titulo">Título</label>
    <input type="text" class="form-control" name="titulo" value="<?=$obVaga->titulo?>">
</div>
<div class="form-group">
    <label for="titulo">Descrição</label>
    <textarea name="descricao" id="" class="form-control" style="resize: none"><?=$obVaga->descricao?></textarea>
</div>
<div class="form-group mt-3">
    <label for="titulo" style="display: block;">Status</label>

    <div style="display: inline-block;">
        <div class="form-check form-check-inline">
            <label for="" class="form-control">
                <input type="radio" name="ativo" id="" value="s" checked> Ativo
            </label>
        </div>
    </div>
    <div class="form-check form-check-inline">
            <label for="" class="form-control">
                <input type="radio" name="ativo" id="" value="n" <?=$obVaga->ativo == 'n' ? "checked" : '' ?>> Inativo
            </label>
        </div>
    </div>
</div> 

<div class="form-group" style="display: flex; justify-content: center;">
<button type="submit" class="btn btn-success">Enviar</button>
</div>

</form>
</main>