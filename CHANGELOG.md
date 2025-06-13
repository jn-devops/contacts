# Changelog

All notable changes to `contacts` will be documented in this file.

## v2.1.31 - 2025-06-13

added relationship_to_buyer field in aif metadata

## v2.1.30 - 2025-06-13

added relationship_to_buyer in aif via data class

## v2.1.29 - 2025-05-21

set default value for coborrowers to be N/A in flatdata

## v2.1.28 - 2025-05-20

updated the flat data, making the spouses field value N/A when civil status is Single

## v2.1.25 - 2025-05-08

added s_name in flat data

## v2.1.24 - 2025-05-08

updated the structure of buyer_name

## v2.1.23 - 2025-05-05

added brn and homeful_id on contacts order

## v2.1.22 - 2025-04-30

added cashDepositProofOfPaymentDocument on contact attachment

## v2.1.21 - 2025-04-23

added government_id_1_type on order

## v2.1.20 - 2025-04-10

added total_number_of_employees in employer metadata class

## v2.1.19 - 2025-03-27

updated the equity_1_amount in flat data

## v2.1.18 - 2025-03-27

updated the EmploymentType enums

## v2.1.17 - 2025-03-26

added rank and years_in_service in EmploymentMetaData and year_established in EmployerMetaData

## v2.1.16 - 2025-03-12

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v2.1.15...v2.1.16

## v2.1.15 - 2025-03-12

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v2.1.14...v2.1.15

## v2.1.14 - 2025-03-10

added dynamic notation for lot_area_in_words

## v2.1.13 - 2025-03-04

chnage in pagibig_filing_site value

## #v2.1.12 - 2025-03-03

add media model

## v2.1.11 - 2025-03-03

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v2.1.10...v2.1.11

## v2.1.10 - 2025-03-03

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v2.1.9...v2.1.10

## v2.1.9 - 2025-03-02

added tin in AIDMetadata

## v2.1.8 - 2025-02-27

added sublocality in addresses

## #v2.1.7 - 2025-02-27

add spouse and address to co-borrower metadata

## #v2.1.6 - 2025-02-26

add name_with_middle_initial computed property to customer, spouse, co-borrower and aif metadata

## #v1.2.6 - 2025-02-26

add civil connection computed property to spouse, co-borrower and aif metadata

## #v2.1.5 - 2025-02-26

fix contact metadata civil_connection computed property

## #v2.1.4 - 2025-02-21

fix the fix

## #v2.1.3 - 2025-02-21

fix $this->civil_status

## #v2.1.2 - 2025-02-21

$this->civil_status instanceof CivilStatus

## #v2.1.1 - 2025-02-21

fix civi_connection

## #v2.1.0 - 2025-02-21

add civil_connection computed attribute

## #v2.0.3 - 2025-02-20

add dummy short_address in address metadata

## v2.0.2 - 2025-02-14

make the employment optional in CoBorrowerMetadata

## #v2.0.1 - 2025-02-13

add canMatch attribute

## #v2.0.0 - 2025-02-09

about time to make this a full upgrade release
add withId in customer factory

## #v1.9.9998 - 2025-02-07

expose id in ContactMetadata

## #v1.9.9996 - 2025-02-07

update the work of Anaïs re documents

## v1.9.9995 - 2025-02-07

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.9.9994...v1.9.9995
pagibig_filing_site on flat_data and relationship_to_owner on co_borrower

## #v1.9.9994 - 2025-02-06

Update Attributes

## #v1.9.993 - 2025-02-06

add order property to ContactMetadata

## #v1.9.992 - 2025-02-06

fix inline classes

## #v1.9.991 - 2025-02-06

all float to null in OrderData

## #v1.9.99 - 2025-02-05

add order data

## #v1.9.98 - 2025-02-05

rename photo4x1WhiteBackground to photoImage

## #v1.9.97 - 2025-02-03

Update Contact Model

## #v1.9.96 - 2025-02-02

fix suffix in CustomerFactory

## #v1.9.95 - 2025-02-02

fix name suffix in computed name

## #v1.9.94 - 2025-02-02

update suffix na to blank string

## #v1.9.93 - 2025-02-02

add suffix cast to name_suffix attribute of spouse and co-borrower

## #v1.9.92 - 2025-02-02

add relation to co-borrower, add suffix enum and update contact metadata

## #v1.9.91 - 2025-02-01

add relation enum

## #v1.9.9 - 2025-02-01

add customer factory

## #v1.9.8 - 2025-01-31

make all fields nullable

## #v1.9.7 - 2025-01-31

make locality optional in AddressMetadata

## #v1.9.6 - 2025-01-31

fix type in Nationality::FAROESE

## #v1.9.5 - 2025-01-31

correct typos in position and nationality enums

## #v1.9.4 - 2025-01-31

add industry, nationality, position enums

## #v1.9.3 - 2025-01-31

add specialty retail to code in industry

## #v1.9.2 - 2025-01-31

add position and tenure enums

## #v1.9.1 - 2025-01-31

add code to industry

## #v1.9.0 - 2025-01-30

add other function to sex enum

## #v1.8.9 - 2025-01-30

make address1 nullable in AddressMetadata

## #v1.8.8 - 2025-01-30

add has code to civil status

## #v1.8.7 - 2025-01-30

add has code to nationality enums

## #v1.8.6 - 2025-01-30

add has code trait

## #v1.8.5 - 2025-01-29

add tryFromCode to employment type and employment status

## #v1.8.4 - 2025-01-29

add fromCode to employment type and employment status

## #v1.8.3 - 2025-01-29

add code to employment type and employment status

## #v1.8.2 - 2025-01-28

add new factory fallback

## #v1.8.1 - 2025-01-28

add configurable factory class to contact model

## #v1.8.0 - 2025-01-28

add configurable connection

## #v1.7.9 - 2025-01-26

add recursive filter

## #v1.7.8 - 2025-01-25

add dummy class to house dummy TIN

## #v1.7.7 - 2025-01-25

add customer model

## #v1.7.6 - 2025-01-12

fix GetContactMetadataFromContactModel to address null attributes

## #v1.7.5 - 2025-01-12

re-release v1.7.4

## #v1.7.4 - 2025-01-12

remove fromModel from ContactMetadata'

## v1.7.3 - 2025-01-12

add fromContactModelToContactMetadata to Contacts facade

## #v1.7.2 - 2025-01-12

comment fromModel in ContactMetadata'

## #v1.7.1 - 2025-01-12

add fromModel in ContactMetadata

## #v1.7.0 - 2025-01-08

Update Enums

## #v1.6.9 - 2025-01-02

fix name suffix in contact meta data'

## #v1.6.8 - 2025-01-02

add name suffix to name attribute

## #v1.6.7 - 2025-01-02

add datetime format in date_of_birth'

## #v1.6.6 - 2025-01-02

fix getNameAttribute if no middle name

## #v1.6.5 - 2025-01-02

add enums and metadata

## v1.6.3 - 2024-12-19

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.6.2...v1.6.3

## v1.6.1 - 2024-12-12

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.6.0...v1.6.1

## #v1.6.0 - 2024-12-12

updated contacts database. add aif. remove password and remember token. made others nullable

## v1.5.87 - 2024-12-06

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.86...v1.5.87

## v1.5.86 - 2024-12-06

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.85...v1.5.86

## v1.5.85 - 2024-12-05

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.84...v1.5.85

## v1.5.84 - 2024-12-05

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.83...v1.5.84

## v1.5.80 - 2024-11-27

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.79...v1.5.80

## v1.5.79 - 2024-11-27

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.78...v1.5.79

## v1.5.78 - 2024-11-27

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.77...v1.5.78

## v1.5.77 - 2024-11-27

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.76...v1.5.77

## v1.5.76 - 2024-11-27

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.75...v1.5.76

## v1.5.74 - 2024-11-26

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.73...v1.5.74

## v1.5.73 - 2024-11-26

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.72...v1.5.73

## v1.5.72 - 2024-11-26

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.71...v1.5.72

## v1.5.71 - 2024-11-26

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.70...v1.5.71

## v1.5.70 - 2024-11-26

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.69...v1.5.70

## v1.5.69 - 2024-11-26

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.68...v1.5.69

## R3nzo321! - 2024-11-26

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.67...v1.5.68

## v1.5.67 - 2024-11-26

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.66...v1.5.67

## v1.5.66 - 2024-11-26

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.65...v1.5.66

## v1.5.65 - 2024-11-26

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.64...v1.5.65

## v1.5.64 - 2024-11-26

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.63...v1.5.64

## v1.5.63 - 2024-11-26

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.62...v1.5.63

## v1.5.62 - 2024-11-26

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.61...v1.5.62

## v1.5.61 - 2024-11-26

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.60...v1.5.61

## v1.5.60 - 2024-11-26

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.59...v1.5.60

## v1.5.59 - 2024-11-26

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.58...v1.5.59

## #v1.5.58 - 2024-11-25

Fix formats for hdmf inputs in FlatData

## #v1.5.57 - 2024-11-25

added aif_attorney details in order, modify the convertNumberToWords in FlatData

## #v1.5.56 - 2024-11-22

added loan_period_in_years on flat data

## #v1.5.55 - 2024-11-21

updated the spouse_salary_gross_incom in flatdata

## v1.5.54 - 2024-11-21

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.53...v1.5.54

## v1.5.53 - 2024-11-21

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.52...v1.5.53

## v1.5.52 - 2024-11-20

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.51...v1.5.52

## v1.5.51 - 2024-11-20

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.50...v1.5.51

## v1.5.50 - 2024-11-20

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.49...v1.5.50

## v1.5.49 - 2024-11-20

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.48...v1.5.49

## v1.5.48 - 2024-11-19

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.47...v1.5.48

## v1.5.47 - 2024-11-19

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.45...v1.5.47

## v1.5.46 - 2024-11-19

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.45...v1.5.46

## v1.5.45 - 2024-11-19

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.44...v1.5.45

## v1.5.44 - 2024-11-19

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.43...v1.5.44

## v1.5.43 - 2024-11-19

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.42...v1.5.43

## v1.5.42 - 2024-11-18

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.41...v1.5.42

## v1.5.41 - 2024-11-18

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.40...v1.5.41

## v1.5.40 - 2024-11-18

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.39...v1.5.40

## v1.5.39 - 2024-11-18

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.38...v1.5.39

## v1.5.38 - 2024-11-17

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.37...v1.5.38

## v1.5.37 - 2024-11-17

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.36...v1.5.37

## v1.5.36 - 2024-11-17

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.35...v1.5.36

## v1.5.35 - 2024-11-17

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.34...v1.5.35

## v1.5.34 - 2024-11-17

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.33...v1.5.34

## v1.5.33 - 2024-11-17

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.32...v1.5.33

## v1.5.32 - 2024-11-14

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.31...v1.5.32

## v1.5.31 - 2024-10-10

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.30...v1.5.31

## v1.5.30 - 2024-10-10

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.29...v1.5.30

## v1.5.29 - 2024-10-03

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.28...v1.5.29

## v1.5.28 - 2024-10-02

lot_area_in_words replace - with space and add lot_area in factory

## v1.5.27 - 2024-10-02

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.26...v1.5.27

## v1.5.26 - 2024-10-02

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.25...v1.5.26

## v1.5.25 - 2024-10-02

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.24...v1.5.25

## v1.5.24 - 2024-10-02

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.23...v1.5.24

## v1.5.23 - 2024-09-26

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.22...v1.5.23

## v1.5.22 - 2024-09-25

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.21...v1.5.22

## v1.5.21 - 2024-09-20

buyer_civil_status_to_lower_case

## v1.5.20 - 2024-09-20

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.19...v1.5.20

## v1.5.19 - 2024-09-19

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.18...v1.5.19

## v1.5.18 - 2024-09-19

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.17...v1.5.18

## v1.5.17 - 2024-09-19

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.16...v1.5.17

## v1.5.16 - 2024-09-19

both_of variable to flatdata

## v1.5.15 - 2024-09-18

add loan_term_in_years and loan_term_in_years_in_words

## v1.5.12 - 2024-09-18

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.11...v1.5.12

## v1.5.11 - 2024-09-17

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.10...v1.5.11

## v1.5.10 - 2024-09-16

**Full Changelog**: https://github.com/jn-devops/contacts/compare/v1.5.9...v1.5.10

## v1.5.9 - 2024-09-13

interest_in_words

## v1.5.8 - 2024-09-12

buyer_civil_status_to flat data

## v1.5.7 - 2024-09-12

Add rank to employement data

## v1.5.6 - 2024-09-12

Add region to address data

## v1.5.5 - 2024-09-11

SignatureImage

## v1.5.4 - 2024-09-11

add employment contact reference, upper case names and number to words fields

## #v1.5.0 - 2024-09-03

make Contact model notifiable

## #v1.4.26 - 2024-09-01

add create contact action based on persist contact action

## #v1.4.4 - 2024-07-18

add fields in order, flat data

## #1.4.3 - 2024-07-01

update migration file, make reference_code and spouse optional

## #v1.4.2 - 2024-06-29

test BorrowerInterface in Contact Model

## #v1.4.1 - 2024-06-29

implement BorrowerInterface in Contact Model

## #v1.4.0 - 2024-06-29

use HasPackageFactory from jn-devops/common

## #v1.3.1 - 2024-06-29

update jn-devops/common:^v1.2.0

## #v1.3.0 - 2024-06-25

add attach-contact-media route

## #v1.2.1 - 2024-06-13

add newFactory() in Contact

## #v1.2.0 - 2024-06-12

add PersistContactAction and end point

## #v1.1.0 - 2024-06-12

Add persist contact action

## #v1.0.1 - 2024-06-11

remove uid, rearrange reference code

## #v1.0.0 - 2024-06-10

decouple contact class from rli-booking
