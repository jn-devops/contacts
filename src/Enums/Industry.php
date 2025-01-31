<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;
use Homeful\Contacts\Traits\HasCode;

enum Industry: string
{
    use EnumUtils;
    use HasCode;

    case ACCOUNTING = 'Accounting';
    case ACTIVITIES_PRIVATE_HOUSEHOLDS = 'Activities of Private Households as Employer\'s & Undifferentiated Production Activities of Private Households';
    case AEROSPACE_DEFENSE = 'Aerospace & Defense';
    case AGRICULTURE = 'Agriculture, Hunting, Forestry & Fishing';
    case AIR_FREIGHT_LOGISTICS = 'Air Freight & Logistics';
    case AUTOMOBILE_COMPONENTS = 'Automobile Components';
    case AUTOMOBILES = 'Automobiles';
    case BANKS = 'Banks';
    case BASIC_MATERIALS = 'Basic Materials';
    case BEVERAGES = 'Beverages';
    case BIOTECHNOLOGY = 'Biotechnology';
    case BROADLINE_RETAIL = 'Broadline Retail';
    case BUILDING_PRODUCTS = 'Building Products';
    case BPO = 'Business Process and Outsourcing (BPO)';
    case BUSINESS_PROCESS_OUTSOURCING = 'Business Process Outsourcing (BPO)';
    case CAPITAL_MARKETS = 'Capital Markets';
    case CHEMICALS = 'Chemicals';
    case COMMERCIAL_SERVICES = 'Commercial Services & Supplies';
    case COMMUNICATIONS_EQUIPMENT = 'Communications Equipment';
    case CONSTRUCTION = 'Construction';
    case CONSTRUCTION_ENGINEERING = 'Construction & Engineering';
    case CONSTRUCTION_MATERIALS = 'Construction Materials';
    case CONSUMER_FINANCE = 'Consumer Finance';
    case CONSUMER_STAPLES_DISTRIBUTION = 'Consumer Staples Distribution & Retail';
    case CONTAINERS_PACKAGING = 'Containers & Packaging';
    case DISTRIBUTORS = 'Distributors';
    case DIVERSIFIED_CONSUMER_SERVICES = 'Diversified Consumer Services';
    case DIVERSIFIED_REITS = 'Diversified REITs';
    case DIVERSIFIED_TELECOMMUNICATION_SERVICES = 'Diversified Telecommunication Services';
    case EDUCATION = 'Education';
    case EDUCATION_TRAINING = 'Education & Training';
    case ELECTRIC_UTILITIES = 'Electric Utilities';
    case ELECTRICAL_EQUIPMENT = 'Electrical Equipment';
    case ELECTRICITY_GAS_WATER_SUPPLY = 'Electricity, Gas and Water Supply';
    case ELECTRONIC_EQUIPMENT = 'Electronic Equipment, Instruments & Components';
    case ENERGY_EQUIPMENT_SERVICES = 'Energy Equipment & Services';
    case ENTERTAINMENT = 'Entertainment';
    case EXTRA_TERRITORIAL_ORG_BODIES = 'Extra-Territorial Organization & Bodies';
    case FINANCIAL_SERVICES = 'Financial Services';
    case FINANCIAL_SERVICES_INTERMEDIATION = 'Financial Services/ Intermediation';
    case FOOD_PRODUCTS = 'Food Products';
    case FUNERAL = 'Funeral';
    case GAS_UTILITIES = 'Gas Utilities';
    case GROUND_TRANSPORTATION = 'Ground Transportation';
    case HEALTH_SOCIAL_WORK = 'Health and Social Work; Health and Medical Services';
    case HEALTH_CARE_EQUIP_SUPPLIES = 'Health Care Equipment & Supplies';
    case HEALTH_CARE_PROVIDERS = 'Health Care Providers & Services';
    case HEALTH_CARE_REITS = 'Health Care REITs';
    case HEALTH_CARE_TECHNOLOGY = 'Health Care Technology';
    case HOTEL_RESORT_REITS = 'Hotel & Resort REITs';
    case HOTELS_RESTAURANTS_LEISURE = 'Hotels, Restaurants & Leisure';
    case HOUSEHOLD_DURABLES = 'Household Durables';
    case HOUSEHOLD_PRODUCTS = 'Household Products';
    case HR_RECRUITMENT = 'HR/Recruitment';
    case INDEPENDENT_POWER_RENEWABLE_ELEC_PRODUCERS = 'Independent Power and Renewable Electricity Producers';
    case INDUSTRIAL_CONGLOMERATES = 'Industrial Conglomerates';
    case INDUSTRIAL_REITS = 'Industrial REITs';
    case INSURANCE = 'Insurance';
    case INTERACTIVE_MEDIA_SERVICES = 'Interactive Media & Services';
    case INTERNET_SOFTWARE_SERVICES = 'Internet Software & Services';
    case IT_SERVICES = 'IT Services';
    case LEISURE_PRODUCTS = 'Leisure Products';
    case LIFE_SCIENCES = 'Life Sciences';
    case LIFE_SCIENCES_TOOLS_SERVICES = 'Life Sciences Tools & Services';
    case MACHINERY = 'Machinery';
    case MANAGEMENT = 'Management';
    case MANPOWER = 'Manpower';
    case MANUFACTURING = 'Manufacturing';
    case MARINE_TRANSPORTATION = 'Marine Transportation';
    case MEDIA = 'Media';
    case METALS_MINING = 'Metals & Mining';
    case MINING_QUARRYING = 'Mining & Quarrying';
    case MORTGAGE_REITS = 'Mortgage Real Estate Investment Trusts (REITs)';
    case MULTI_UTILITIES = 'Multi-Utilities';
    case OFFICE_REITS = 'Office REITs';
    case OIL_GAS_CONSUMABLE_FUELS = 'Oil, Gas & Consumable Fuels';
    case OTHER_COMMUNITY_SOCIAL_SERVICES = 'Other Community, Social & Personal Service Activities';
    case PAPER_FOREST_PRODUCTS = 'Paper & Forest Products';
    case PASSENGER_AIRLINES = 'Passenger Airlines';
    case PERSONAL_CARE_PRODUCTS = 'Personal Care Products';
    case PHARMACEUTICALS = 'Pharmaceuticals';
    case PROFESSIONAL_SERVICES = 'Professional Services';
    case PUBLIC_ADMIN_DEFENSE = 'Public Administration & Defense; Compulsory Social Security';
    case REAL_ESTATE_MANAGEMENT = 'Real Estate Management & Development';
    case RESIDENTIAL_REITS = 'Residential REITs';
    case RETAIL_REITS = 'Retail REITs';
    case SEMICONDUCTORS_SEMICONDUTOR_EQUIPMENT = 'Semiconductors & Semiconductor Equipment';
    case SOFTWARE = 'Software';
    case SPECIALIZED_REITS = 'Specialized REITs';
    case SPECIALTY_RETAIL = 'Specialty Retail';
    case TECHNOLOGY = 'Technology';
    case TECHNOLOGY_HARDWARE = 'Technology Hardware, Storage & Peripherals';
    case TEXTILES_APPAREL_LUXURY_GOODS = 'Textiles, Apparel & Luxury Goods';
    case TOBACCO = 'Tobacco';
    case TRADING_COMPANIES_DISTRIBUTORS = 'Trading Companies & Distributors';
    case TRANSPORT_STORAGE_COMMUNICATIONS = 'Transport, Storage & Communications';
    case TRANSPORTATION_INFRASTRUCTURE = 'Transportation Infrastructure';
    case TRAVEL_LEISURE = 'Travel & Leisure';
    case UNEMPLOYED = 'Unemployed';
    case WATER_UTILITIES = 'Water Utilities';
    case WHOLESALE_RETAIL_TRADE_REPAIR = 'Wholesale & Retail Trade; Repair of Motor vehicles, Motorcycles, Personal and Household Goods';
    case WIRELESS_TELECOMMUNICATION_SERVICES = 'Wireless Telecommunication Services';

    static function default(): self {
        return self::UNEMPLOYED;
    }

    public function code(): string
    {
        return match ($this) {
            self::ACCOUNTING => '001',
            self::ACTIVITIES_PRIVATE_HOUSEHOLDS => '002',
            self::AEROSPACE_DEFENSE => '003',
            self::AGRICULTURE => '004',
            self::AIR_FREIGHT_LOGISTICS => '005',
            self::AUTOMOBILE_COMPONENTS => '006',
            self::AUTOMOBILES => '007',
            self::BANKS => '008',
            self::BASIC_MATERIALS => '009',
            self::BEVERAGES => '010',
            self::BIOTECHNOLOGY => '011',
            self::BROADLINE_RETAIL => '012',
            self::BUILDING_PRODUCTS => '013',
            self::BPO => '014',
            self::BUSINESS_PROCESS_OUTSOURCING => '015',
            self::CAPITAL_MARKETS => '016',
            self::CHEMICALS => '017',
            self::COMMERCIAL_SERVICES => '018',
            self::COMMUNICATIONS_EQUIPMENT => '019',
            self::CONSTRUCTION => '020',
            self::CONSTRUCTION_ENGINEERING => '021',
            self::CONSTRUCTION_MATERIALS => '022',
            self::CONSUMER_FINANCE => '023',
            self::CONSUMER_STAPLES_DISTRIBUTION => '024',
            self::CONTAINERS_PACKAGING => '025',
            self::DISTRIBUTORS => '026',
            self::DIVERSIFIED_CONSUMER_SERVICES => '027',
            self::DIVERSIFIED_REITS => '028',
            self::DIVERSIFIED_TELECOMMUNICATION_SERVICES => '029',
            self::EDUCATION => '030',
            self::EDUCATION_TRAINING => '031',
            self::ELECTRIC_UTILITIES => '032',
            self::ELECTRICAL_EQUIPMENT => '033',
            self::ELECTRICITY_GAS_WATER_SUPPLY => '034',
            self::ELECTRONIC_EQUIPMENT => '035',
            self::ENERGY_EQUIPMENT_SERVICES => '036',
            self::ENTERTAINMENT => '037',
            self::EXTRA_TERRITORIAL_ORG_BODIES => '038',
            self::FINANCIAL_SERVICES => '039',
            self::FINANCIAL_SERVICES_INTERMEDIATION => '040',
            self::FOOD_PRODUCTS => '041',
            self::FUNERAL => '042',
            self::GAS_UTILITIES => '043',
            self::GROUND_TRANSPORTATION => '044',
            self::HEALTH_SOCIAL_WORK => '045',
            self::HEALTH_CARE_EQUIP_SUPPLIES => '046',
            self::HEALTH_CARE_PROVIDERS => '047',
            self::HEALTH_CARE_REITS => '048',
            self::HEALTH_CARE_TECHNOLOGY => '049',
            self::HOTEL_RESORT_REITS => '050',
            self::HOTELS_RESTAURANTS_LEISURE => '051',
            self::HOUSEHOLD_DURABLES => '052',
            self::HOUSEHOLD_PRODUCTS => '053',
            self::HR_RECRUITMENT => '054',
            self::INDEPENDENT_POWER_RENEWABLE_ELEC_PRODUCERS => '056',
            self::INDUSTRIAL_CONGLOMERATES => '057',
            self::INDUSTRIAL_REITS => '058',
            self::INSURANCE => '059',
            self::INTERACTIVE_MEDIA_SERVICES => '060',
            self::INTERNET_SOFTWARE_SERVICES => '061',
            self::IT_SERVICES => '062',
            self::LEISURE_PRODUCTS => '063',
            self::LIFE_SCIENCES => '064',
            self::LIFE_SCIENCES_TOOLS_SERVICES => '065',
            self::MACHINERY => '066',
            self::MANAGEMENT => '067',
            self::MANPOWER => '068',
            self::MANUFACTURING => '069',
            self::MARINE_TRANSPORTATION => '070',
            self::MEDIA => '071',
            self::METALS_MINING => '072',
            self::MINING_QUARRYING => '073',
            self::MORTGAGE_REITS => '075',
            self::MULTI_UTILITIES => '076',
            self::OFFICE_REITS => '077',
            self::OIL_GAS_CONSUMABLE_FUELS => '078',
            self::OTHER_COMMUNITY_SOCIAL_SERVICES => '079',
            self::PAPER_FOREST_PRODUCTS => '080',
            self::PASSENGER_AIRLINES => '081',
            self::PERSONAL_CARE_PRODUCTS => '082',
            self::PHARMACEUTICALS => '083',
            self::PROFESSIONAL_SERVICES => '084',
            self::PUBLIC_ADMIN_DEFENSE => '085',
            self::REAL_ESTATE_MANAGEMENT => '086',
            self::RESIDENTIAL_REITS => '087',
            self::RETAIL_REITS => '088',
            self::SEMICONDUCTORS_SEMICONDUTOR_EQUIPMENT => '089',
            self::SOFTWARE => '090',
            self::SPECIALIZED_REITS => '091',
            self::SPECIALTY_RETAIL => '092',
            self::TECHNOLOGY => '093',
            self::TECHNOLOGY_HARDWARE => '094',
            self::TEXTILES_APPAREL_LUXURY_GOODS => '095',
            self::TOBACCO => '096',
            self::TRADING_COMPANIES_DISTRIBUTORS => '097',
            self::TRANSPORT_STORAGE_COMMUNICATIONS => '098',
            self::TRANSPORTATION_INFRASTRUCTURE => '100',
            self::TRAVEL_LEISURE => '101',
            self::UNEMPLOYED => '102',
            self::WATER_UTILITIES => '103',
            self::WHOLESALE_RETAIL_TRADE_REPAIR => '104',
            self::WIRELESS_TELECOMMUNICATION_SERVICES => '106',
        };
    }
}
