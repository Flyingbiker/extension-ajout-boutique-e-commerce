<?php
/**
 * Page PHP pour afficher le formulaire dans l'admin WooCommerce Produits/Catégories
 * Page insérée dans edit-tag-form.fr
 * @package WordPress
 * @subpackage Administration
 */


/**
 * Formulaire à afficher
 */
?>
<form name="generate_description" id="generate_description" method="post" action="" class="validate">
		<h3>Formulaire pour générer le descriptif pour la boutique</h3>
		<table class="form-table">
			<tbody>
				<tr class="form-field">
					<th>
						<label for="background-color_category_description">Background-color</label>
					</th>
					<td>
						<input type="color" name="background-color_category_description" id="background-color_category_description">
						<p class="description" class="description">Couleur qui va se mettre dans le fond de la boutique sur la page d'accueil</p>
					</td>
				</tr>
				<tr>
					<th>
						<label for="url_category_description">URL de l'image</label>
					</th>
					<td>
						<input type="text" name="url_image_description" id="url_image_description">
						<p class="description">URL de l'image qui va être affichée pour la boutique sur la page d'accueil</p>
					</td>
				</tr>
				<tr>
					<th>
						<label for="bool_category_description">Est-ce que la boutique est ouverte ?</label>
					</th>
					<td>
						<select name="bool_category_description" id="bool_category_description">
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
						<p class="description">Si oui, la boutique est affichée sur la page principale </p>
					</td>
				</tr>
				<tr>
					<th>
						<label for="date_open_category_description">Date d'ouverture</label>
					</th>
					<td>
						<input type="date" name="date_open_category_description" id="date_open_category_description">
						<p class="description">La date d'ouverture de la boutique va permettre de conditionner l'affichage de la boutique sur la page principale </p>
					</td>
				</tr>
				<tr>
					<th>
						<label for="date_close_category_description">Date de fermeture</label>
					</th>
					<td>
						<input type="date" name="date_close_category_description" id="date_close_category_description">
						<p class="description">La date de fermeture de la boutique va permettre de conditionner l'affichage de la boutique sur la page principale </p>
					</td>
				</tr>
				<tr>
					<th>
						<label for="text_date_category_description">Texte boutique</label>
					</th>
					<td>
						<input type="text" name="text_date_category_description" id="text_date_category_description" disabled>
						
						<p class="description">Texte affiché sur la boutique</p>
					</td>
				</tr>
				<tr>
					<th>
						<label for="">Nom de la page boutique</label>
					</th>
					<td>
						<select name="name_page_shop" id="name_page_shop">
							<?php $pages = get_pages( array('sort_column' => 'post_title')); 
								foreach($pages as $key => $value){
									foreach($value as $keyValue =>$item){
										if ($keyValue === 'post_title'){
											?>
											<option value="<?= $item ?>"><?= $item ?></option>
											<?php
										}
									}
								};
							?>
						</select>
						<p class="description">Indiquer le nom de la page qui héberge la boutique privée</p>
					</td>
				</tr>
				<tr>
					<th>
						<label for="url_slug_category_description">URL + slug de la boutique</label>
					</th>
					<td>
						<textarea name="url_slug_category_description" id="url_slug_category_description" 
							cols="30" rows="4" disabled><?php global $wp;
								echo home_url( $wp->request ) ?></textarea>
						<p class="description">Afficher l'url de la boutique // A SUPPRIMER</p>
					</td>
				</tr>
				<tr>
					<th>
						<label for="shipping_type_category_description">Type de livraison</label>
					</th>
					<td>
                        <select name="shipping_type_category_description" id="shipping_type_category_description">
							<option value="1">Livraison club</option>
							<option value="2">Livraison domicile gratuite</option>
							<option value="3">Livraison domicile payante</option>

						</select>
						<p class="description">Type de livraison de la boutique</p>
					</td>
				</tr>
				<tr>
                    <td>
                        <button id="serialize_button">Serializer la description</button>
                    </td>
				</tr>
			</tbody>
		</table>




		</div>
	</form>