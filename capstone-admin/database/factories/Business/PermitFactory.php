<?php

namespace Database\Factories\Business;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business\Permit>
 */
class PermitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $permits = [
            "industry-specific requirements",
            "ameding a permit",
            "renewing a permit",
            "other transactions",
        ];
        $requirements = <<<EOD
#### Additional requirements for specific businesses

- Clinics
- Day Care Center – Day Care Accreditation (DSWD)
- Funeral Parlors – CENRO Clearance
- Hauling Services – CENRO Clearance
- High Risk Businesses – TMO Clearance
- Homeowners Associations – Certification (DHSUD)
- Hospital – License to Operate (DOH)
- Hotels – License to Operate (DOT)
- Laboratory – License to Operate (DOH)
- Laundry – CENRO Clearance
- Lawyers, Physicians, and other professions claiming exception – Professional Tax Receipt (PTR)
- Learning Institutions – Recognition or Certificate (DepEd)
- Lying-in Clinics or Birthing Homes – License to Operate (DOH)
- Meat Seller or Distributor – Certificate of Accreditation or License to Operate (NMIS)
- New Business/Transferee – Certificate of Retirement from the previous business location, Financial Statement & VAT Returns, and Amendment SEC or G.I.S. w/SEC Stamp
- PEZA Registered Enterprise – PEZA Registration, Certificate of Entitlement, ITH Holiday, B.I.R., Form 1702 Q and O.R. Showing 2% Shares payment to Taguig
- Pharmacy and businesses that sell or manufacture cosmetics – License to Operate (FDA)
- Private Lending Companies – Certificate of Authority (SEC)
- Private Technical Vocational Schools – Recognition (TESDA)
- Private Tertiary and University – Recognition (CHED)
- Selling or repair of guns – PNP Clearance
- Stalls Located at the Sta. Ana talipapa – Certificate (MMO)
- Veterinary Clinics and Pet Grooming – Certification of Registration BAI
EOD;

        return [
            "title" => fake()->randomElement($permits),
            "description" => "Certain types of businesses have additional requirements before they can operate. Listed below are some of the industry-specific requirements that you must submit.",
            "requirements" => $requirements,
        ];
    }
}
