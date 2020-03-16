<form action="index.php?uc=creerCompte" class="form-signin container" method="POST">
    <div class="text-center mb-4">
        <h1>Créer un compte :</h1>
    </div>
    <div class="form-label-group text-center">
        <input class="form-control" name="name" type="text" placeholder="Nom" required />
        <br/>
        <input class="form-control" name="email" type="text" placeholder="Email" required/>
        <br/>
        <input class="form-control" name="password" type="password" placeholder="Password" required />
    </div>
    <br/>
    <div class="form-label-group text-center">
        <button class="btn btn-lg btn-success" type="submit" >Valider</button>
    </div>
</form>