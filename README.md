# Homeful Contacts Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jn-devops/contacts.svg?style=flat-square)](https://packagist.org/packages/jn-devops/contacts)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/jn-devops/contacts/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/jn-devops/contacts/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/jn-devops/contacts/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/jn-devops/contacts/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/jn-devops/contacts.svg?style=flat-square)](https://packagist.org/packages/jn-devops/contacts)

---

## Description

The **Homeful Contacts Package** is a comprehensive solution for managing customer and borrower contact details, including personal information, employment data, addresses, and uploaded documents. It features advanced metadata handling to ensure structured and reliable contact management.

### Key Features:
- **Customer & Contact Models**: Supports customer and borrower contact details.
- **Contact Metadata**: Provides structured metadata for employment, addresses, and uploaded documents.
- **Media Handling**: Supports various document types such as IDs, contracts, invoices, and receipts.
- **Integration with Borrower Interface**: Ensures seamless connection with the borrowing system.
- **Phone Number Validation**: Uses Laravel Phone for formatted phone number management.

---

## Installation

Install via Composer:

```bash
composer require jn-devops/contacts
```

---

## Usage

### 🔹 Creating a Contact

```php
use Homeful\Contacts\Models\Contact;

$contact = Contact::create([
    'first_name' => 'Juan',
    'last_name' => 'Dela Cruz',
    'email' => 'juan.delacruz@example.com',
    'mobile' => '09171234567',
    'date_of_birth' => '1990-05-15',
]);
```

### 🔹 Creating a Customer

```php
use Homeful\Contacts\Models\Customer;

$customer = Customer::create([
    'first_name' => 'Maria',
    'last_name' => 'Santos',
    'email' => 'maria.santos@example.com',
    'mobile' => '09181234567',
]);
```

### 🔹 Associating Employment Details

```php
$customer->employment = [
    [
        'type' => 'Primary',
        'monthly_gross_income' => 50000,
        'employment_status' => 'Regular',
        'employer' => [
            "name" => "Tech Solutions Inc.",
            "email" => "hr@techsolutions.com",
            "address" => [
                "type" => "Primary",
                "region" => "NCR",
                "country" => "PH",
                "address1" => "123 Makati Avenue, Makati City",
                "postal_code" => "1200"
            ],
            "industry" => "Technology",
        ]
    ]
];

$customer->save();
```

### 🔹 Handling Uploaded Documents

```php
$customer->addMediaFromUrl('https://example.com/uploads/id_image.jpg')->toMediaCollection('id-images');
$customer->addMediaFromUrl('https://example.com/uploads/contract.pdf')->toMediaCollection('contract-documents');
```

### 🔹 Retrieving Contact Metadata

```php
use Homeful\Contacts\Classes\ContactMetaData;

$contactMetadata = ContactMetaData::from($customer->toArray());
```

---

## Testing

Run tests using:

```bash
composer test
```

---

## Author

- **Lester B. Hurtado**  
  Email: [devops@joy-nostalg.com](mailto:devops@joy-nostalg.com)  
  GitHub: [jn-devops](https://github.com/jn-devops)

---

## License

This package is open-source software licensed under the **MIT License**. See the [License File](LICENSE.md) for details.
