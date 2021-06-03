<?php 
    /* Si aucune session est en cours*/
    if (!isset($_SESSION['user'])) {
             echo '	<h3 class="modal-title text-center" id="exampleModalLabel">Connexion</h3>
            		<div class="col-6 mx-auto">
            			<form method="post">
            			<input type="hidden" name="form" value="connexion" />
            				<div class="form-group">
            					<label for="recipient-name">Pseudo :</label>
            					<input type="text" class="form-control form-control-lg" id="recipient-name" name="identifiant" maxlenght="15" />
            				</div>
            				<div class="form-group">
            					<label for="message-text" >Mot de passe :</label>
            					<input type="password" class="form-control form-control-lg" id="recipient-name" name="mdp" maxlenght="15"/>
            				</div>
            				<button class="btn bg-info" type="submit" name="submit"> Se connecter</button> <!-- redirige grace au php -->			
            			</form>
            		</div>';
    }/* Sinon (une session existe déjà redirige dans le back) */
    else { header("Location: http://localhost/BSassPortfolio/?page=admin&table=profile");  }
$content.= "Je suis là mais dans php content";
?>
<p>Je suis là</p>