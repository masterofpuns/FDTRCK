<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\About>
 */
class AboutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->text(100),
            'text' => $this->faker->randomElement($this->getHtmlIpsum()),
            'button_text' => 'Bezoek onze website',
            'button_url' => 'https://dutchcodingcompany.com',
            'copyright_title' => $this->faker->text(100),
            'copyright_text' => $this->faker->randomElement($this->getHtmlIpsum()),
        ];
    }

    public function getHtmlIpsum(): array
    {
        return [
            <<<'HTML1'
            <h1>Graecum enim hunc versum nostis omnes-: Suavis laborum est praeteritorum memoria.</h1>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed fortuna fortis; Quae similitudo in genere etiam humano apparet. Quare attende, quaeso. Quae est igitur causa istarum angustiarum? <i>Re mihi non aeque satisfacit, et quidem locis pluribus.</i> Expectoque quid ad id, quod quaerebam, respondeas. </p>

            <ol>
                <li>Quae adhuc, Cato, a te dicta sunt, eadem, inquam, dicere posses, si sequerere Pyrrhonem aut Aristonem.</li>
                <li>Tum Piso: Atqui, Cicero, inquit, ista studia, si ad imitandos summos viros spectant, ingeniosorum sunt;</li>
                <li>Sed residamus, inquit, si placet.</li>
                <li>Scientiam pollicentur, quam non erat mirum sapientiae cupido patria esse cariorem.</li>
                <li>Audio equidem philosophi vocem, Epicure, sed quid tibi dicendum sit oblitus es.</li>
                <li>Et harum quidem rerum facilis est et expedita distinctio.</li>
            </ol>


            <p><a href="http://loripsum.net/" target="_blank">Cur post Tarentum ad Archytam?</a> Duo Reges: constructio interrete. Tum Torquatus: Prorsus, inquit, assentior; Non est igitur voluptas bonum. At iste non dolendi status non vocatur voluptas. Age, inquies, ista parva sunt. Bonum valitudo: miser morbus. </p>

            <ul>
                <li>Haec dicuntur fortasse ieiunius;</li>
                <li>Illis videtur, qui illud non dubitant bonum dicere -;</li>
                <li>Videamus animi partes, quarum est conspectus illustrior;</li>
                <li>Nihil acciderat ei, quod nollet, nisi quod anulum, quo delectabatur, in mari abiecerat.</li>
            </ul>
            HTML1,
            <<<'HTML2'
            <h1>Causa autem fuit huc veniendi ut quosdam hinc libros promerem.</h1>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Addidisti ad extremum etiam indoctum fuisse. Qui-vere falsone, quaerere mittimus-dicitur oculis se privasse; Et quidem, inquit, vehementer errat; Ne discipulum abducam, times. <b>Duo Reges: constructio interrete.</b> Invidiosum nomen est, infame, suspectum. </p>

            <h2>Quid ait Aristoteles reliquique Platonis alumni?</h2>

            <p>Restatis igitur vos; Quae contraria sunt his, malane? Ille incendat? Venit ad extremum; Teneo, inquit, finem illi videri nihil dolere. Aliter homines, aliter philosophos loqui putas oportere? Eam tum adesse, cum dolor omnis absit; Comprehensum, quod cognitum non habet? </p>
            HTML2,
            <<<'HTML3'
            <h1>Quid, quod res alia tota est?</h1>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <b>Immo alio genere;</b> <i>Primum divisit ineleganter;</i> Duo Reges: constructio interrete. Quo tandem modo? Gloriosa ostentatio in constituendo summo bono. Et nemo nimium beatus est; Quae autem natura suae primae institutionis oblita est? </p>

            <h2>Ut aliquid scire se gaudeant?</h2>

            <p>Quid iudicant sensus? Poterat autem inpune; Quippe: habes enim a rhetoribus; <i>Idem adhuc;</i> </p>
            HTML3,
        ];
    }
}
