-- GET ALL BENEFICIARIES
SELECT b.*, bk.bank_name, ba.bank_account_number, ba.bank_account_title, ec.employee_category_name
FROM beneficiaries b
LEFT JOIN vendors v ON b.vendor_id = v.vendor_id
LEFT JOIN employees e ON b.employee_id = e.employee_id
LEFT JOIN employee_categories ec on e.employee_category	=	ec.employee_category_id
LEFT JOIN bank_accounts ba on v.bank_account	=	ba.bank_account_id
LEFT JOIN banks bk on ba.bank_account_bank	=	bk.bank_id
WHERE b.employee_id IS NULL
UNION
SELECT b.*, bk.bank_name, ba.bank_account_number, ba.bank_account_title, ec.employee_category_name
FROM beneficiaries b
LEFT JOIN employees e ON b.employee_id = e.employee_id
LEFT JOIN employee_categories ec on e.employee_category	=	ec.employee_category_id
LEFT JOIN bank_accounts ba on e.bank_account	=	ba.bank_account_id
LEFT JOIN banks bk on ba.bank_account_bank	=	bk.bank_id
WHERE b.vendor_id IS NULL
ORDER BY beneficiary_name


-- ANOTHER
SELECT b.*, ba.* FROM beneficiaries b LEFT JOIN employees e ON b.employee_id = e.employee_id LEFT JOIN bank_accounts ba ON b.beneficiary_bank_account = ba.bank_account_id WHERE b.vendor_id IS NULL UNION SELECT b.*, ba.* FROM beneficiaries b LEFT JOIN vendors v ON v.vendor_id = b.vendor_id LEFT JOIN bank_accounts ba ON b.beneficiary_bank_account = ba.bank_account_id WHERE b.employee_id IS NULL;
