<div class="row">
	<div class="col-xs-12">
		<div class="center">
			<h3>Tableau de bord</h3>
		</div>
		<div class="row">
			<div class="center">
            <?php
                include('includes/dashboard-tables.php');
                $tables = [
                    "Publication(s)"      =>  "posts",
                    "Commentaire(s)"      =>  "comments",
                ];
                $colors = [
                    "posts"             =>  "green",
                    "comments"          =>  "orange",
                ];
                foreach($tables as $table_name => $table){
                    ?>
                        <div class="col l4 m6 s12">
                            <div class="card">
                                <div class="card-content <?= getColor($table,$colors) ?> white-text">
                                    <span class="card-title"><?= $table_name ?></span>
                                    <?php $nbrInTable = inTable($table); ?>
                                    <h4><?= $nbrInTable[0] ?></h4>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            ?>
			</div>	
        </div>
        <div class="center">
			<a class="btn light-blue waves-effect" title="Se déconnecter" href="index.php?p=logout"><i class="material-icons left">exit_to_app</i>Se déconnecter</a></li>
        </div>
	</div>
</div>