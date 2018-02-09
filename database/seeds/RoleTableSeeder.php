<?php

use App\Category;
use App\Family;
use App\Vegetation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Role;
use App\Distribution;
use App\User;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
//        DB::table('users')->truncate();
        DB::table('distributions')->truncate();
        DB::table('categories')->truncate();
        DB::table('vegetations')->truncate();
        DB::table('families')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        /*( pure stand, random, border)*/
        Distribution::create([
            'name' => 'Pure Stand',
        ]);
        Distribution::create([
            'name' => 'Random',
        ]);
        Distribution::create([
            'name' => 'Border',
        ]);
        Category::create([
            'name' => 'Herb (Perrenial)',
        ]);
        Category::create([
            'name' => 'Shrub',
        ]);
        Category::create([
            'name' => 'Tree',
        ]);
        Vegetation::create(['name'=>'DF']);
        Vegetation::create(['name'=>'MF']);
        Vegetation::create(['name'=>'MoF']);
        Vegetation::create(['name'=>'Mo-PF']);
        Vegetation::create(['name'=>'AE']);
        Family::create(['name' => 'Acanthaceae']);
        Family::create(['name' => 'Aceraceae']);
        Family::create(['name' => 'Actinidaceae']);
        Family::create(['name' => 'Cornaceae']);
        Family::create(['name' => 'Alpiniaceae']);
        Family::create(['name' => 'Anacardiaceae']);
        Family::create(['name' => 'Annonaceae']);
        Family::create(['name' => 'Apocynaceae']);
        Family::create(['name' => 'Apostaciaceae']);
        Family::create(['name' => 'Aquifoliaceae']);
        Family::create(['name' => 'Araceae']);
        Family::create(['name' => 'Araliaceade']);
        Family::create(['name' => 'Arecaceae']);
        Family::create(['name' => 'Aristolochiaceae']);
        Family::create(['name' => 'Asclepiadaceae']);
        Family::create(['name' => 'Balanophoraceae']);
        Family::create(['name' => 'Begoniaceae']);
        Family::create(['name' => 'Bignoniaceae']);
        Family::create(['name' => 'Bombaceae']);
        Family::create(['name' => 'Burseraceae']);
        Family::create(['name' => 'Caelsaltheniaceae']);
        Family::create(['name' => 'Campanulaceae']);
        Family::create(['name' => 'Casuarinaceae']);
        Family::create(['name' => 'Celastraceae']);
        Family::create(['name' => 'Chloranthaceae']);
        Family::create(['name' => 'Clethraceae']);
        Family::create(['name' => 'Clusiaceae']);
        Family::create(['name' => 'Combretaceae']);
        Family::create(['name' => 'Compositae']);
        Family::create(['name' => 'Convulvolaceae']);
        Family::create(['name' => 'Nyssaceae']);
        Family::create(['name' => 'Cucurbitaceae']);
        Family::create(['name' => 'Cunoniaceae']);
        Family::create(['name' => 'Cyperaceae']);
        Family::create(['name' => 'Daphniphyllaceae']);
        Family::create(['name' => 'Datiscaceae']);
        Family::create(['name' => 'Dilleniaceae']);
        Family::create(['name' => 'Dioscoraceae']);
        Family::create(['name' => 'Dipterocarpaceae']);
        Family::create(['name' => 'Ebenaceae']);
        Family::create(['name' => 'Elaeocarpaceae']);
        Family::create(['name' => 'Epacridaceae']);
        Family::create(['name' => 'Ericaceae']);
        Family::create(['name' => 'Eriocaulaceae']);
        Family::create(['name' => 'Euphorbiaceae']);
        Family::create(['name' => 'Fabaceae or Leguminosae']);
        Family::create(['name' => 'Fagaceae']);
        Family::create(['name' => 'Flacourtiaceae']);
        Family::create(['name' => 'Flagelariaceaea']);
        Family::create(['name' => 'Gesneriaceae']);
        Family::create(['name' => 'Goodeniaceae']);
        Family::create(['name' => 'Grossolaniaceae']);
        Family::create(['name' => 'Hydrangiaceae']);
        Family::create(['name' => 'Iridaceae']);
        Family::create(['name' => 'Ixonanthaceae']);
        Family::create(['name' => 'Labiatae or Lamiaceae']);
        Family::create(['name' => 'Lauraceae']);
        Family::create(['name' => 'Lecythidaceae']);
        Family::create(['name' => 'Lentibulariaceae']);
        Family::create(['name' => 'Liliaceae']);
        Family::create(['name' => 'Lobeliaceae']);
        Family::create(['name' => 'Loganiaceae']);
        Family::create(['name' => 'Loranthaceae']);
        Family::create(['name' => 'Magnoliaceae']);
        Family::create(['name' => 'Malvacea']);
        Family::create(['name' => 'Maranthaceae']);
        Family::create(['name' => 'Melastomataceae']);
        Family::create(['name' => 'Meliaceae']);
        Family::create(['name' => 'Menispermaceae']);
        Family::create(['name' => 'Moraceae']);
        Family::create(['name' => 'Myristicaceae']);
        Family::create(['name' => 'Myrtaceae']);
        Family::create(['name' => 'Nepenthaceae']);
        Family::create(['name' => 'Ochnaceae']);
        Family::create(['name' => 'Orchidaceae']);
        Family::create(['name' => 'Pandanaceae']);
        Family::create(['name' => 'Piperaceae']);
        Family::create(['name' => 'Pittosporaceae']);
        Family::create(['name' => 'Poaceae']);
        Family::create(['name' => 'Polygalaceae']);
        Family::create(['name' => 'Proteaceae']);
        Family::create(['name' => 'Rhamnaceae']);
        Family::create(['name' => 'Rhizoporaceae']);
        Family::create(['name' => 'Rosaceae']);
        Family::create(['name' => 'Rubiaceae']);
        Family::create(['name' => 'Rutaceae']);
        Family::create(['name' => 'Sabaceae']);
        Family::create(['name' => 'Santalaceae']);
        Family::create(['name' => 'Sapindaceae']);
        Family::create(['name' => 'Sapotaceae']);
        Family::create(['name' => 'Saxifragaceae']);
        Family::create(['name' => 'Scropluriaceae']);
        Family::create(['name' => 'Simaroubaceae']);
        Family::create(['name' => 'Smilacaceae']);
        Family::create(['name' => 'Sonneraticeae']);
        Family::create(['name' => 'Staphyliaceae']);
        Family::create(['name' => 'Sterculiaceae']);
        Family::create(['name' => 'Symplococaceae']);
        Family::create(['name' => 'Theaceae']);
        Family::create(['name' => 'Thymelaeaceae']);
        Family::create(['name' => 'Urticaceae']);
        Family::create(['name' => 'Verbenaceae']);
        Family::create(['name' => 'Vitaceae']);
        Family::create(['name' => 'Winteraceae']);
        Family::create(['name' => 'Zingiberaceae']);
        Family::create(['name' => 'Araucariaceae']);
        Family::create(['name' => 'Cycadaceae']);
        Family::create(['name' => 'Gnetaceae']);
        Family::create(['name' => 'Podocarpaceae']);
        Family::create(['name' => 'FERN']);
        Family::create(['name' => 'Adiantaceae']);
        Family::create(['name' => 'Aspidiaceae']);
        Family::create(['name' => 'Aspleniaceae']);
        Family::create(['name' => 'Blechnaceae']);
        Family::create(['name' => 'Cyatheaceae']);
        Family::create(['name' => 'Davalliaceae']);
        Family::create(['name' => 'Dennstaedtiaceae']);
        Family::create(['name' => 'Dicksoniaceae']);
        Family::create(['name' => 'Deptiridaceae']);
        Family::create(['name' => 'Gesneriaceae']);
        Family::create(['name' => 'Gleichniaceae']);
        Family::create(['name' => 'Grammitidaceae']);
        Family::create(['name' => 'Hymenophyllaceae']);
        Family::create(['name' => 'Lindseaceae']);
        Family::create(['name' => 'Lomariopsidaceae']);
        Family::create(['name' => 'Loxogrammaceae']);
        Family::create(['name' => 'Marattiaceae']);
        Family::create(['name' => 'Oleandraceae']);
        Family::create(['name' => 'Ophioglossaceae']);
        Family::create(['name' => 'Osmundaceae']);
        Family::create(['name' => 'Plagiogyriaceae']);
        Family::create(['name' => 'Polypodiaceae']);
        Family::create(['name' => 'Lycopodiaceae']);
        Family::create(['name' => 'Psilotaceae']);
        Family::create(['name' => 'Selaginellaceae']);

        Role::create([
            'id' => 1,
            'name' => 'Root',
            'description' => 'Use this account with extreme caution. When using this account it is possible to cause irreversible damage to the system.'
        ]);
        Role::create([
            'id' => 2,
            'name' => 'Administrator',
            'description' => 'Full access to create, edit, and update companies, and orders.'
        ]);
        Role::create([
            'id' => 3,
            'name' => 'Manager',
            'description' => 'Ability to create new companies and orders, or edit and update any existing ones.'
        ]);
        Role::create([
            'id' => 4,
            'name' => 'Company Manager',
            'description' => 'Able to manage the company that the user belongs to, including adding sites, creating new users and assigning licences.'
        ]);
        Role::create([
            'id' => 5,
            'name' => 'User',
            'description' => 'A standard user that can have a licence assigned to them. No administrative features.'
        ]);
        /*User::create([
            'name' => 'Edward Lance Lorilla',
            'email' => 'edward@io.com',
            'password' => bcrypt('edward'),
            'role_id' => 2,
            'firebase_uid' => 'dsK5esUN6tXKiCpl8kbkQtZmXYD3',
            'remember_token' => str_random(10),
        ]);*/

    }
}
