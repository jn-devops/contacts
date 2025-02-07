<?php

namespace Homeful\Contacts\Traits;

use Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait HasUploads
{
//    /** idImage */
//    public function setIdImageAttribute(?string $url): static
//    {
//        if ($url) {
//            $this->addMediaFromUrl($url)
//                ->usingName('idImage')
//                ->toMediaCollection('id-images');
//        }
//
//        return $this;
//    }
//    public function getIdImageAttribute(): ?Media
//    {
//        return $this->getFirstMedia('id-images');
//    }
//
//    /** selfieImage */
//    public function setSelfieImageAttribute(?string $url): static
//    {
//        if ($url) {
//            $this->addMediaFromUrl($url)
//                ->usingName('selfieImage')
//                ->toMediaCollection('selfie-images');
//        }
//
//        return $this;
//    }
//    public function getSelfieImageAttribute(): ?Media
//    {
//        return $this->getFirstMedia('selfie-images');
//    }

//    /** payslipImage */
//    public function setPayslipImageAttribute(?string $url): static
//    {
//        if ($url) {
//            $this->addMediaFromUrl($url)
//                ->usingName('payslipImage')
//                ->toMediaCollection('payslip-images');
//        }
//
//        return $this;
//    }
//    public function getPayslipImageAttribute(): ?Media
//    {
//        return $this->getFirstMedia('payslip-images');
//    }

//    /** signatureImage */
//    public function setSignatureImageAttribute(?string $url): static
//    {
//        if ($url) {
//            $this->addMediaFromUrl($url)
//                ->usingName('signatureImage')
//                ->toMediaCollection('signature-images');
//        }
//
//        return $this;
//    }
//    public function getSignatureImageAttribute(): ?Media
//    {
//        return $this->getFirstMedia('signature-images');
//    }

//    /** voluntarySurrenderFormDocument */
//    public function setVoluntarySurrenderFormDocumentAttribute(?string $url): static
//    {
//        if ($url) {
//            $this->addMediaFromUrl($url)
//                ->usingName('voluntarySurrenderFormDocument')
//                ->toMediaCollection('voluntary_surrender_form-documents');
//        }
//
//        return $this;
//    }
//    public function getVoluntarySurrenderFormDocumentAttribute(): ?Media
//    {
//        return $this->getFirstMedia('voluntary_surrender_form-documents');
//    }

//    /** usufructAgreementDocument */
//    public function setUsufructAgreementDocumentAttribute(?string $url): static
//    {
//        if ($url) {
//            $this->addMediaFromUrl($url)
//                ->usingName('usufructAgreementDocument')
//                ->toMediaCollection('usufruct_agreement-documents');
//        }
//
//        return $this;
//    }
//    public function getUsufructAgreementDocumentAttribute(): ?Media
//    {
//        return $this->getFirstMedia('usufruct_agreement-documents');
//    }

//    /** contractToSellDocument */
//    public function setContractToSellDocumentAttribute(?string $url): static
//    {
//        if ($url) {
//            $this->addMediaFromUrl($url)
//                ->usingName('contractToSellDocument')
//                ->toMediaCollection('contract_to_sell-documents');
//        }
//
//        return $this;
//    }
//    public function getContractToSellDocumentAttribute(): ?Media
//    {
//        return $this->getFirstMedia('contract_to_sell-documents');
//    }

//    /** deedOfRestrictionsDocument */
//    public function setDeedOfRestrictionsDocumentAttribute(?string $url): static
//    {
//        if ($url) {
//            $this->addMediaFromUrl($url)
//                ->usingName('deedOfRestrictionsDocument')
//                ->toMediaCollection('deed_of_restrictions-documents');
//        }
//
//        return $this;
//    }
//    public function getDeedOfRestrictionsDocumentAttribute(): ?Media
//    {
//        return $this->getFirstMedia('deed_of_restrictions-documents');
//    }

//    /** disclosureDocument */
//    public function setDisclosureDocumentAttribute(?string $url): static
//    {
//        if ($url) {
//            $this->addMediaFromUrl($url)
//                ->usingName('disclosureDocument')
//                ->toMediaCollection('disclosure-documents');
//        }
//
//        return $this;
//    }
//    public function getDisclosureDocumentAttribute(): ?Media
//    {
//        return $this->getFirstMedia('disclosure-documents');
//    }

//    /** borrowerConformityDocument */
//    public function setBorrowerConformityDocumentAttribute(?string $url): static
//    {
//        if ($url) {
//            $this->addMediaFromUrl($url)
//                ->usingName('borrowerConformityDocument')
//                ->toMediaCollection('borrower_conformity-documents');
//        }
//
//        return $this;
//    }
//    public function getBorrowerConformityDocumentAttribute(): ?Media
//    {
//        return $this->getFirstMedia('borrower_conformity-documents');
//    }

//    /** statementOfAccountDocument */
//    public function setStatementOfAccountDocumentAttribute(?string $url): static
//    {
//        if ($url) {
//            $this->addMediaFromUrl($url)
//                ->usingName('statementOfAccountDocument')
//                ->toMediaCollection('statement_of_account-documents');
//        }
//
//        return $this;
//    }
//    public function getStatementOfAccountDocumentAttribute(): ?Media
//    {
//        return $this->getFirstMedia('statement_of_account-documents');
//    }

//    /** invoiceDocument */
//    public function setInvoiceDocumentAttribute(?string $url): static
//    {
//        if ($url) {
//            $this->addMediaFromUrl($url)
//                ->usingName('invoiceDocument')
//                ->toMediaCollection('invoice-documents');
//        }
//
//        return $this;
//    }
//    public function getInvoiceDocumentAttribute(): ?Media
//    {
//        return $this->getFirstMedia('invoice-documents');
//    }

//    /** receiptDocument */
//    public function setReceiptDocumentAttribute(?string $url): static
//    {
//        if ($url) {
//            $this->addMediaFromUrl($url)
//                ->usingName('receiptDocument')
//                ->toMediaCollection('receipt-documents');
//        }
//
//        return $this;
//    }
//    public function getReceiptDocumentAttribute(): ?Media
//    {
//        return $this->getFirstMedia('receipt-documents');
//    }

//    /** deedOfSaleDocument */
//    public function setDeedOfSaleDocumentAttribute(?string $url): static
//    {
//        if ($url) {
//            $this->addMediaFromUrl($url)
//                ->usingName('deedOfSaleDocument')
//                ->toMediaCollection('deed_of_sale-documents');
//        }
//
//        return $this;
//    }
//    public function getDeedOfSaleDocumentAttribute(): ?Media
//    {
//        return $this->getFirstMedia('deed_of_sale-documents');
//    }

//    /** governmentId1 */
//    public function getGovernmentId1ImageAttribute(): ?Media
//    {
//        return $this->getFirstMedia('government_id1-images');
//    }
//    public function setGovernmentId1ImageAttribute(?string $url): static
//    {
//        if ($url) {
//            $this->addMediaFromUrl($url)
//                ->usingName('governmentId1Image')
//                ->toMediaCollection('government_id1-images');
//        }
//
//        return $this;
//    }
}
