<?php
	ob_start();
	session_start();
	if(isset($_SESSION['user'])!="" && ($_SESSION['tipo'])==2){
		include_once 'dbconnect.php';

		$error = false;
		$buscar = trim($_POST['busqueda']);
		$buscar = strip_tags($buscar);
		$buscar = htmlspecialchars($buscar);

	?>
	<div class="container">
	<div class="row">
        <div class="col-md-6">
    		<h2>Custom search field</h2>
            <div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="text" class="form-control input-lg" placeholder="Buscar" />
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="button">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
	</div>
</div>
	<?php ob_end_flush();
	}else{
		header("Location: home.php");
	}
	 ?>
