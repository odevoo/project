<?php $this->layout('layout', ['title' => 'Formulaire d\'inscription']) ?>

<?php $this->start('main_content') ?>
    <?php if (isset($_SESSION['flash'])): ?>
        <?php debug($_SESSION) ?>
    <?php endif ?>
    <div class="row">
        <div class="col-md-6">
            <button  class="btn btn-primary" disabled id="btn-student" type="">Etudiant</button>
        </div>
        <div class="col-md-6">
            <button  class="btn btn-primary" id="btn-teacher" type="">Professeur</button>
        </div>
    </div>
    <div id="form-student">
        <form class="" method="post" action="<?= $this->url('admin_process_register') ?>">
            <div class="form-group">
                <label for="firstname">Prénom</label>
                <input class="form-control"  type="text" name="firstname" id="firstname" placeholder="">
            </div>
            <div class="form-group">
                <label for="lastname">Nom</label>
                <input class="form-control" type="text" name="lastname" id="lastname" placeholder="">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" placeholder="">
            </div>
            <div class="form-group">
                <label for="address">Adresse</label>
                <input type="text" id="autocomplete"  onFocus="geolocate()" class="autocomplete form-control" name="" value="" placeholder="Adresse">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="btn" value="S'inscrire">
            </div>
            <input type="hidden" name="type" value="student">
            <input type="hidden" name="streetNumber" id="autocomplete_street_number"  value="">
            <input type="hidden" name="address" id="autocomplete_route"  value="">
            <input type="hidden" name="city" id="autocomplete_locality"  value="">
            <input type="hidden" name="zip" id="autocomplete_postal_code"  value="">
            <input type="hidden" name="lat" id="autocomplete_lat"  value="">
            <input type="hidden" name="lng" id="autocomplete_lng"  value="">
        </form>
    </div>
    <div id="form-teacher" class="hidden">
        <form  method="post" enctype="multipart/form-data" action="<?= $this->url('admin_process_register') ?>">
            <div class="form-group">
                <label for="firstname">Prénom</label>
                <input class="form-control"  type="text" name="firstname" id="firstname" placeholder="">
            </div>
            <div class="form-group">
                <label for="lastname">Nom</label>
                <input class="form-control" type="text" name="lastname" id="lastname" placeholder="">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" placeholder="">
            </div>
            <div class="form-group">
                <label for="address">Adresse</label>
                <input type="text" id="autocompleteteach"  onFocus="geolocate()" class="autocomplete form-control" name="" value="" placeholder="Adresse">
            </div>
            <div class="form-group">
                <label for="rating">Tarif horaire</label>
                <input class="form-control" type="number" name="rating" id="rating" placeholder="">
            </div>
            <div class="form-group">
                <label for="desc">Description</label>
                <textarea class="form-control" name="desc" id="desc" placeholder="" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="avatar">Avatar</label>
                <input class="form-control" type="file" name="file" id="file" placeholder="">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="btn" value="S'inscrire">
            </div>
            <input type="hidden" name="type" value="teacher">
            <input type="hidden" name="streetNumber" id="autocompleteteach_street_number"  value="">
            <input type="hidden" name="address" id="autocompleteteach_route"  value="">
            <input type="hidden" name="city" id="autocompleteteach_locality"  value="">
            <input type="hidden" name="zip" id="autocompleteteach_postal_code"  value="">
            <input type="hidden" name="lat" id="autocompleteteach_lat"  value="">
            <input type="hidden" name="lng" id="autocompleteteach_lng"  value="">
        </form>
    </div>    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVvV3H3-rcwoX6X-Jq1PXMOhiF-6EyO-E&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>
    <script type="text/javascript" src="<?= $this->assetUrl('js/googleplaceteacher.js') ?>"></script>
    <script type="text/javascript" src="<?= $this->assetUrl('js/scriptregister.js') ?>"></script>
<?php $this->stop('main_content') ?>
