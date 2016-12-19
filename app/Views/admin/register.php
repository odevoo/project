<?php $this->layout('layout', ['title' => 'Formulaire d\'inscription']) ?>

<?php $this->start('main_content') ?>
    <ul class="nav nav-tabs nav-justified">
      <li id="btn-student" role="presentation" class="active"><a href="#form-student" type="">Etudiant</a></li>
      <li id="btn-teacher" role="presentation"><a href="#form-teacher"   type="">Professeur</a></li>
    </ul>

  <div class="register-container tab-content">
    <div id="form-student" role="tabpanel" class="tab-pane active">
        <form  method="post" action="<?= $this->url('admin_process_register') ?>">
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
    <div id="form-teacher" role="tabpanel" class="tab-pane">
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
                <label for="subjects">Matière</label>
                <?php foreach (array_chunk($subjects, 6 , true) as $subjectschunk): ?>
                    <div class="row">
                        <?php foreach ($subjectschunk as $subject): ?>
                            <div class="col-md-2">
                                <input name="<?= $subject['id'] ?>" type="checkbox"><?= $subject['name'] ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>

            </div>
            <div class="form-group">
                <label for="level">Niveau maximum enseigné</label>
                <select class="form-control" name="level" id="level">
                    <option selected disabled value="">Selectionnez un niveau</option>
                    <?php foreach ($levels as $level): ?>
                        <option value="<?= $level['id'] ?>"><?= $level['level'] ?></option>}
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="mobility">Mobilité</label>
                <select id="mobility" class="form-control" name="mobility">
                    <option selected disabled value="">Selectionnez votre mobilité</option>
                    <option value="Domicile">Domicile</option>
                    <option value="Chez l'étudiant">Chez l'étudiant</option>
                    <option value="Au choix">Au choix</option>

                </select>
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
            <input type="hidden" name="nbSubjects" value="<?= count($subjects) ?>">
        </form>
    </div>
  </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVvV3H3-rcwoX6X-Jq1PXMOhiF-6EyO-E&signed_in=true&libraries=places&callback=initAutocomplete" async defer></script>
    <script type="text/javascript" src="<?= $this->assetUrl('js/googleplace.js') ?>"></script>
    <script type="text/javascript" src="<?= $this->assetUrl('js/scriptregister.js') ?>"></script>
<?php $this->stop('main_content') ?>
