-- TRANSACTIONS ALL
SELECT 
td.transaction_detail_id,
tr.transaction_date, tr.transaction_type,
ca.company_account_title, ca.company_account_number, bnk2.bank_name,
td.transaction_detail_date, td.transaction_cluster, td.transaction_detail_purpose,
p.project_name,
be.beneficiary_name, ba.bank_account_title, ba.bank_account_number, bnk.bank_name,
be1.beneficiary_name, ba1.bank_account_title, ba1.bank_account_number, bnk.bank_name,
tc.transaction_category_name
FROM
transaction_details as td
LEFT JOIN transactions as tr
	ON td.transaction_cluster =	tr.transaction_cluster
    -- INTERMEDIATE
LEFT JOIN beneficiaries as be
	ON be.beneficiary_id	=	td.transaction_detail_intermediate_beneficiary
    -- DESTINATION
LEFT JOIN beneficiaries as be1
	ON be1.beneficiary_id	=	td.transaction_detail_destination_beneficiary
LEFT JOIN transaction_categories as tc
	ON td.transaction_detail_category	=	tc.transaction_category_id
LEFT JOIN projects as p
	ON p.project_id	=	td.transaction_detail_project
LEFT JOIN company_accounts as ca
	ON ca.company_account_id	=	tr.transaction_account_used
    -- INTERMEDIATE
LEFT JOIN bank_accounts as ba
	ON ba.bank_account_id	=	be.beneficiary_bank_account
    -- DESTINATION
LEFT JOIN bank_accounts as ba1
	ON ba1.bank_account_id	=	be1.beneficiary_bank_account
    -- INTERMEDIATE
LEFT JOIN banks as bnk
	ON bnk.bank_id	=	ba.bank_account_bank
    -- DESTINATION
LEFT JOIN banks as bnk1
	ON bnk1.bank_id	=	ba1.bank_account_bank
    -- COMPANY
LEFT JOIN banks as bnk2
	ON bnk2.bank_id	=	ca.company_account_bank
GROUP BY td.transaction_detail_id



-- ALIASES COLUMNS
-- TRANSACTIONS ALL
SELECT 
  td.transaction_detail_id as detail_id,
  tr.transaction_date as date,
  tr.transaction_type as type,
  ca.company_account_title as account_title,
  ca.company_account_number as account_number,
  bnk2.bank_name as bank_name,
  td.transaction_detail_date as detail_date,
  td.transaction_cluster as cluster,
  td.transaction_detail_purpose as purpose,
  p.project_name as project_name,
  be.beneficiary_name as intermediate_name,
  be.beneficiary_type	as intermeddiate_type,
  ba.bank_account_title as intermediate_account_title,
  ba.bank_account_number as intermediate_account_number,
  bnk.bank_name as intermediate_bank_name,
  be1.beneficiary_name as destination_name,
  be1.beneficiary_type	as destination_type,
  ba1.bank_account_title as destination_account_title,
  ba1.bank_account_number as destination_account_number,
  bnk.bank_name as destination_bank_name,
  tc.transaction_category_name as category_name
FROM
  transaction_details as td
  LEFT JOIN transactions as tr
    ON td.transaction_cluster = tr.transaction_cluster
  -- INTERMEDIATE
  LEFT JOIN beneficiaries as be
    ON be.beneficiary_id = td.transaction_detail_intermediate_beneficiary
  -- DESTINATION
  LEFT JOIN beneficiaries as be1
    ON be1.beneficiary_id = td.transaction_detail_destination_beneficiary
  LEFT JOIN transaction_categories as tc
    ON td.transaction_detail_category = tc.transaction_category_id
  LEFT JOIN projects as p
    ON p.project_id = td.transaction_detail_project
  LEFT JOIN company_accounts as ca
    ON ca.company_account_id = tr.transaction_account_used
  -- INTERMEDIATE
  LEFT JOIN bank_accounts as ba
    ON ba.bank_account_id = be.beneficiary_bank_account
  -- DESTINATION
  LEFT JOIN bank_accounts as ba1
    ON ba1.bank_account_id = be1.beneficiary_bank_account
  -- INTERMEDIATE
  LEFT JOIN banks as bnk
    ON bnk.bank_id = ba.bank_account_bank
  -- DESTINATION
  LEFT JOIN banks as bnk1
    ON bnk1.bank_id = ba1.bank_account_bank
  -- COMPANY
  LEFT JOIN banks as bnk2
    ON bnk2.bank_id = ca.company_account_bank
GROUP BY td.transaction_detail_id


