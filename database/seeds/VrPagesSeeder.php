<?php

use App\Models\VrPages;
use App\Models\VRPagesTranslations;
use App\Models\VRResources;
use Illuminate\Database\Seeder;

class VrPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {$resuorces = [
        ["id" => "the_lab_img", "mime_type" => "image/jpg", "path" => "/vrImage/the-lab.jpg"],
        ["id" => "samsung_irk_img", "mime_type" => "image/jpg", "path" => "/vrImage/20170211_100034.jpg"],
        ["id" => "fruit_ninja_img", "mime_type" => "image/jpg" ,"path" => "/vrImage/fruit-ninja-vr-screenshot-3.jpg"],
        ["id" => "ktu_par_img", "mime_type" => "image/jpg", "path" => "/vrImage/parasparnis.jpg"],
        ["id" => "space_pirate_trainer_img", "mime_type" => "image/jpg", "path" => "/vrImage/posterscreen-u5344-fr.jpg"],
        ["id" => "hurl_img", "mime_type" => "image/jpg", "path" => "/vrImage/hurl2.jpg"],
        ["id" => "tilt_brush_img", "mime_type" => "image/jpg", "path" => "/vrImage/google_tiltbrushtrailer16.jpg"],
        ["id" => "football_simulator_img", "mime_type" => "image/jpg", "path" => "/vrImage/sim.jpg"],
        ["id" => "merry_snowballs_img", "mime_type" => "image/jpg", "path" => "/vrImage/hide-using-your-surroundings-merry-snowballs 02.jpg"],
        ["id" => "project_cars_img", "mime_type" => "image/jpg", "path" => "/vrImage/project cars.jpg"],
    ];


        $pages = [
            ["id" => "the_lab", "category_id" => "virtual_room", "cover_id" => "the_lab_img"],
            ["id" => "samsung_irk", "category_id" => "virtual_room", "cover_id" => "samsung_irk_img"],
            ["id" => "fruit_ninja", "category_id" => "virtual_room", "cover_id" => "fruit_ninja_img"],
            ["id" => "ktu_par", "category_id" => "virtual_room", "cover_id" => "ktu_par_img"],
            ["id" => "space_pirate_trainer", "category_id" => "virtual_room", "cover_id" => "space_pirate_trainer_img"],
            ["id" => "hurl", "category_id" => "virtual_room", "cover_id" => "hurl_img"],
            ["id" => "tilt_brush", "category_id" => "virtual_room", "cover_id" => "tilt_brush_img"],
            ["id" => "football_simulator", "category_id" => "virtual_room", "cover_id" => "football_simulator_img"],
            ["id" => "merry_snowballs", "category_id" => "virtual_room", "cover_id" => "merry_snowballs_img"],
            ["id" => "project_cars", "category_id" => "virtual_room", "cover_id" => "project_cars_img"],
        ];


        $pagesTranslations = [


            ["record_id" => "the_lab",
                "language_code" => "lt",
                "title" => "Labaratoryja",
                "description_short" =>
                    "Tavo pilį puolą žvėriški barbarai, o tu turi tik lanką, kad juos sustabdytum",
                "description_long" =>
                    "Tačiau tai viskas ko reikia tokiam patyrusiam kariui kaip tu - apsaugok savo pilį nuo priešų.",
                "slug" => "/labaratoryja"
            ],
            ["record_id" => "samsung_irk",
                "language_code" => "lt",
                "title" => "Samsung irklavimas",
                "description_short" =>
                    "Išbandyk savo jėgas irkluodamas",
                "description_long" =>
                    "Trakų ežere su Rio olimpiados vicečempionu Saulium Riteriu.",
                "slug" => "/samsung_irklavimas"
            ],
            ["record_id" => "fruit_ninja",
                "language_code" => "lt",
                "title" => "Vaisių ninzė",
                "description_short" =>
                    "Garsusis Fruit Ninja žaidimas",
                "description_long" =>
                    "Žaidimas persikelia į virtualia realybę su dar daugiau smagumynų.
                     Du kardai, 4 skirtingi režimai, nesuskaičiuojama gausa vaisių. ",
                "slug" => "/vaisiu_ninze"
            ],
            ["record_id" => "ktu_par",
                "language_code" => "lt",
                "title" => "KTU parasparnis",
                "description_short" =>
                    "Suvaldyk parasparnį ir nuleisk jį.",
                "description_long" =>
                    "Ant KTU pastato nesugadindamas. Daugiau lankų surinksi pakeliui - daugiau taškų pelnysi.",
                "slug" => "/ktu_parasparnis"
            ],
            ["record_id" => "space_pirate_trainer",
                "language_code" => "lt",
                "title" => "Kosmoso piratai",
                "description_short" =>
                    "Tai puiki proga išpildyti vaikystės svajonę.",
                "description_long" =>
                    "Būti kosmoso piratu. Čia išmoksi visko ko tau reikės. Paimk skydą, nutaikyk ginklą ir pirmyn!",
                "slug" => "/kosmoso_piratai"
            ],
            ["record_id" => "hurl",
                "language_code" => "lt",
                "title" => "Svaidymas kamuolio",
                "description_short" =>
                    "Įmonės TeleSoftas sukurtas VR potyris, skirtas kamuolio gerbėjams – taigi kone kiekvienam lietuviui.",
                "description_long" =>
                    " Kol kas tai galvosūkių žaidimas, kuriame visos kliūtys įveikiamos tiesiog mėtant kamuolį.
                     Tiesa, prieš pasiekdamas lanką, kamuolys turi atsitrenkti į tam tikrą kiekį platformų. ",
                "slug" => "/svaidymas_kamuolio"
            ],
            ["record_id" => "tilt_brush",
                "language_code" => "lt",
                "title" => "Piešimas",
                "description_short" =>
                    "Išbandyk savo piešimo įgūdžius 3D erdvėje!",
                "description_long" =>
                    "Nupiešk paveikslą ar žmogų, sukurk parką ar pastatyk namą. Ribų nėra! Išlaisvink kūrybikšumą!",
                "slug" => "/piesimas"
            ],
            ["record_id" => "football_simulator",
                "language_code" => "lt",
                "title" => "Vartininkas",
                "description_short" =>
                    "Tapk vartininku!",
                "description_long" =>
                    "Įlipk į vartininko kailį ir atalikyk pačius sudėtingiausius smūgius į tavo vartus.",
                "slug" => "/vartininkas"
            ],
            ["record_id" => "merry_snowballs",
                "language_code" => "lt",
                "title" => "Gniūžtės",
                "description_short" =>
                    "Išpildyk vaikystės svajonę",
                "description_long" =>
                    "Ir pasinerk į nepakartojamą sniego karą.
                     Apsisaugok nuo kitų gniūščių su šušklių dėžės dangčiu arba pasislėpdamas už tvoros.
                      O sniego šautuvas padės įrodyti kad esi kiečiausias vaikas kieme.",
                "slug" => "/gniuztes"
            ],
            ["record_id" => "project_cars",
                "language_code" => "lt",
                "title" => "Lenktyninkas",
                "description_short" =>
                    "Atsisėk prie automobilio vairo.",
                "description_long" =>
                    "Ir parodyk kad esi geriausias vairuotojas mieste. Vingiuoti posūkiai ir aršūs oponentai jau laukia tavęs!",
                "slug" => "/lenktyninkas"
            ],

        ];



        DB::beginTransaction();
        try {

            foreach ($resuorces as $resuorce) {
                $record = VRResources::find($resuorce['id']);
                if (!$record) {
                    VRResources::create($resuorce);
                }
            }

            foreach ($pages as $page) {
                $record = VrPages::find($page['id']);
                if (!$record) {
                    VrPages::create($page);
                }
            }


            foreach ($pagesTranslations as $pageTranslation) {
                $record = VRPagesTranslations::where('record_id', $pageTranslation['record_id'])
                                                ->where('language_code', $pageTranslation ['language_code'])
                                                ->first();
                if (!$record) {
                    VRPagesTranslations::create($pageTranslation);
                }
            }


        } catch (Exception $e) {
            DB::rollback();
            echo 'Point of failure '. $e->getCode() . ' ' . $e->getMessage();
            throw new Exception($e);
        }
        DB::commit();
    }
}
