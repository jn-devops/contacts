<?php

namespace Homeful\Contacts\Enums;

use Homeful\Common\Traits\EnumUtils;

enum Industry: string
{
    use EnumUtils;

    case ACCOUNTING = 'Accounting';
    case ACTIVITIES_OF_PRIVATE_HOUSEHOLDS = "Activities of Private Households as Employer's & Undifferentiated Production Activities of Private Households";
    case AEROSPACE_DEFENSE = 'Aerospace & Defense';
    case AGRICULTURE_HUNTING_FORESTRY_FISHING = 'Agriculture, Hunting, Forestry & Fishing';
    case AIR_FREIGHT_LOGISTICS = 'Air Freight & Logistics';
    case AUTOMOBILE_COMPONENTS = 'Automobile Components';
    case AUTOMOBILES = 'Automobiles';
    case BANKS = 'Banks';
    case BASIC_MATERIALS = 'Basic Materials';
    case BEVERAGES = 'Beverages';
    case BIOTECHNOLOGY = 'Biotechnology';
    case BROADLINE_RETAIL = 'Broadline Retail';
    case BUILDING_PRODUCTS = 'Building Products';
    case BUSINESS_PROCESS_OUTSOURCING_BPO = 'Business Process and Outsourcing (BPO)';
    case CAPITAL_MARKETS = 'Capital Markets';
    case CHEMICALS = 'Chemicals';
    case COMMERCIAL_SERVICES_SUPPLIES = 'Commercial Services & Supplies';
    case COMMUNICATIONS_EQUIPMENT = 'Communications Equipment';
    case CONSTRUCTION = 'Construction';
    case CONSTRUCTION_ENGINEERING = 'Construction & Engineering';
    case CONSTRUCTION_MATERIALS = 'Construction Materials';
    case CONSUMER_FINANCE = 'Consumer Finance';
    case CONSUMER_STAPLES_DISTRIBUTION_RETAIL = 'Consumer Staples Distribution & Retail';
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
    case ELECTRONIC_EQUIPMENT_INSTRUMENTS_COMPONENTS = 'Electronic Equipment, Instruments & Components';
    case ENERGY_EQUIPMENT_SERVICES = 'Energy Equipment & Services';
    case ENTERTAINMENT = 'Entertainment';
    case EXTRA_TERRITORIAL_ORGANIZATION_BODIES = 'Extra-Territorial Organization & Bodies';
    case FINANCIAL_SERVICES = 'Financial Services';
    case FINANCIAL_SERVICES_INTERMEDIATION = 'Financial Services/ Intermediation';
    case FOOD_PRODUCTS = 'Food Products';
    case FUNERAL = 'Funeral';
    case GAS_UTILITIES = 'Gas Utilities';
    case GROUND_TRANSPORTATION = 'Ground Transportation';
    case HEALTH_SOCIAL_WORK = 'Health and Social Work; Health and Medical Services';
    case HEALTH_CARE_EQUIPMENT_SUPPLIES = 'Health Care Equipment & Supplies';
    case HEALTH_CARE_PROVIDERS_SERVICES = 'Health Care Providers & Services';
    case HEALTH_CARE_REITS = 'Health Care REITs';
    case HEALTH_CARE_TECHNOLOGY = 'Health Care Technology';
    case HOTEL_RESORT_REITS = 'Hotel & Resort REITs';
    case HOTELS_RESTAURANTS_LEISURE = 'Hotels, Restaurants & Leisure';
    case HOUSEHOLD_DURABLES = 'Household Durables';
    case HOUSEHOLD_PRODUCTS = 'Household Products';
    case HR_RECRUITMENT = 'HR/Recruitment';
    case INDEPENDENT_POWER_RENEWABLE_ELECTRICITY_PRODUCERS = 'Independent Power and Renewable Electricity Producers';
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
    case OTHER_COMMUNITY_SOCIAL_PERSONAL_SERVICE = 'Other Community, Social & Personal Service Activities';
    case PAPER_FOREST_PRODUCTS = 'Paper & Forest Products';
    case PASSENGER_AIRLINES = 'Passenger Airlines';
    case PERSONAL_CARE_PRODUCTS = 'Personal Care Products';
    case PHARMACEUTICALS = 'Pharmaceuticals';
    case PROFESSIONAL_SERVICES = 'Professional Services';
    case PUBLIC_ADMINISTRATION_DEFENSE = 'Public Administration & Defense; Compulsory Social Security';
    case REAL_ESTATE_MANAGEMENT_DEVELOPMENT = 'Real Estate Management & Development';
    case RESIDENTIAL_REITS = 'Residential REITs';
    case RETAIL_REITS = 'Retail REITs';
    case SEMICONDUCTORS_SEMICONDUTOR_EQUIPMENT = 'Semiconductors & Semiconductor Equipment';
    case SOFTWARE = 'Software';
    case SPECIALIZED_REITS = 'Specialized REITs';
    case SPECIALTY_RETAIL = 'Specialty Retail';
    case TECHNOLOGY = 'Technology';
    case TECHNOLOGY_HARDWARE_STORAGE_PERIPHERALS = 'Technology Hardware, Storage & Peripherals';
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
        return self::BPO;
    }
}
