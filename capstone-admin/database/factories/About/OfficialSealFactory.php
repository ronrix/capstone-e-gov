<?php

namespace Database\Factories\About;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\About\OfficialSeal>
 */
class OfficialSealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "symbol_logo_img_link" => "https://pilillarizal.gov.ph/wp-content/uploads/2022/12/logo-symbolism-0_1_orig.jpg",
            "logo" => json_encode([
                [
                    "title" => "better pililla",
                    "description" => trim('
                        “BETTER PILILLA” the home of 54 MW Windfarm – our tagline which anchors our governance that leads to the fulfillment of all its Strategic Goals – massive tax campaign, health, special and educational services, human development through skills and development training, increased economic opportunities through business-friendly policies, and infrastructure development which result in attaining the DILG-Seal of Good Local Governance (SGLG) in one year of its first term of public service. (source: LGPMS Profile)
                    '),
                    "img_link" => "https://pilillarizal.gov.ph/wp-content/uploads/2022/09/BetterPilillaLogo-1016x400-1-768x302.png"
                ],
                [
                    "title" => "aray ng pililla",
                    "description" => trim('
                        Ang hugis ng logo na animo araw ay sumisimbulo sa panahon ng tag-init o panahon ng pag-aani kung kailan din ipinagdiriwang ang Araw ng Pililla. Ito ay ginawang makulay na sumasagisag sa ating pagiging likas na masayahin. Ito ay napapalibutan ng siyam na hugis ng tao na nagmistulang sinag na kumakatawan sa siyam na nagkakaisang Barangay at mga mamamayan nito. Ang logo ay makikitaan din ng mga simbulong sumasagisag sa mga lugar at produktong tanyag sa Bayan ng Pililla.
                    '),
                    "img_link" => "https://pilillarizal.gov.ph/wp-content/uploads/2022/12/araw-ng-pililla-logo-png.png"
                ],
            ])
        ];
    }
}
