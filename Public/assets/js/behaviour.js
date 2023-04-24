$(document).ready(
    ()=>{
        // DATATABLE
        $('table.list').DataTable();
        // DIALOGUE MODEL
        let dialogue    =   $('.model-dialogue');
        let disgardButton    =   $('.model-dialogue .foot button');
        let closeDialogue   =   $('.model-dialogue .close-model');
        closeDialogue.on('click', ()=>{
            dialogue.hide();
        })
        disgardButton.on('click', ()=>{
            dialogue.hide();
        })
        // DELETE TRANSACTION
        let transactionDeleteButtons = $('.Transaction_list td a.danger');
        transactionDeleteButtons.each(function() {
            $(this).on('click', function(e) {
                javascript:void(0);
                e.preventDefault();
                let value   =   $(this).attr('href');
                let yesButton   =   dialogue.find('.foot a');
                yesButton.attr('href', value);
                dialogue.show();
            });
        });
        
        // DELETE CLIENT
        let clientDeleteButtons =   $('.clients_list .col:last-child a.danger');
        clientDeleteButtons.each(function() {
            $(this).on('click', function(e) {
                javascript:void(0);
                e.preventDefault();
                let value   =   $(this).attr('href');
                let yesButton   =   dialogue.find('.foot a');
                yesButton.attr('href', value);
                dialogue.show();
            });
        });
        // DELETE Vendor
        let vendorDeleteButtons =   $('.vendors_list .col:last-child a.danger');
        vendorDeleteButtons.each(function() {
            $(this).on('click', function(e) {
                javascript:void(0);
                e.preventDefault();
                let value   =   $(this).attr('href');
                let yesButton   =   dialogue.find('.foot a');
                yesButton.attr('href', value);
                dialogue.show();
            });
        });
        // DELETE employee
        let employeeDeleteButtons =   $('.employees_list .col:last-child a.danger');
        employeeDeleteButtons.each(function() {
            $(this).on('click', function(e) {
                javascript:void(0);
                e.preventDefault();
                let value   =   $(this).attr('href');
                let yesButton   =   dialogue.find('.foot a');
                yesButton.attr('href', value);
                dialogue.show();
            });
        });
        // DELETE project
        let projectsDeleteButtons =   $('.projects_list .col:last-child a.danger');
        projectsDeleteButtons.each(function() {
            $(this).on('click', function(e) {
                javascript:void(0);
                e.preventDefault();
                let value   =   $(this).attr('href');
                let yesButton   =   dialogue.find('.foot a');
                yesButton.attr('href', value);
                dialogue.show();
            });
        });
        // ADD TEAM MEMEBER
            // GENERATE TEAM MEMEBERS
            let teamMemberGeneratorButton   =   $('.team-member-generator');
            let memberDetail                =   $('form.add-team-member .form_group:first');
            console.log(memberDetail)
            teamMemberGeneratorButton.on('click', ()=>{
                let clone   =   memberDetail.clone();
                let member  =   clone.find('select').val("");
                clone.insertBefore(teamMemberGeneratorButton);

            })

            //ADD ONLINE TRANSACTION PAGE
        //ADD ONLINE TRANSACTION PAGE
        //CHANGING VALUE OF DESTINATION ON INTERMIDATE SELECT
        let intermidiate    =   $('form.add_online_transaction #intermediate');
        let destination    =   $('form.add_online_transaction #destination');
        intermidiate.on('change', ()=>{
            destination.val(intermidiate.find(":checked").val());
        })


        //ADD WITHDRAWAL TRANSACTIONS
        //ADD WITHDRAWAL TRANSACTIONS

        // AMOUNT FIELD GENERATOR

        let amountFeildGeneratorButton  =   $('form.add_withdrawal_transaction .amount_field_generator');
        let amountGroup                 =   $('form.add_withdrawal_transaction .amount_group:first-child');
        let parent                 =   $('form.add_withdrawal_transaction .amount_multiple');

        amountFeildGeneratorButton.on('click',
            ()=>{
                let clone   =   amountGroup.clone();
                console.dir(clone)
                clone.find('.amount_input').val("");
                clone.find(".transaction_id").remove();
                clone.insertBefore(amountFeildGeneratorButton);
            }
        )
        // SETTING VALUE OF FIRST DETAIL DATE TO VALUE SELECTED IN TRANSACTION
        let withdrawalDate =   $('#withdrawal_date');
        let count   =   0;
        withdrawalDate.on('change',()=>{
            if (count   ==  0){
                let detail_date     =   $('.detail_date');
                detail_date.val(withdrawalDate.val());
            }
        })
        withdrawalDate.on('blur', ()=>{
            count   =   1;
        })
        // Wtithdrawal Details Generater
        let withdrawalDetails = $('form.add_withdrawal_transaction .withdrawal_details .detail:first-child');
        let withdrawalDetailsGenerator = $('form.add_withdrawal_transaction .withdrawal_details .detail_generator');
        let withDrawalIntermidiate = $('form.add_withdrawal_transaction .withdrawal_details .detail .intermediate');
        let withDrawalDestination = $('form.add_withdrawal_transaction .withdrawal_details .detail .destination');
        withDrawalIntermidiate.on('change', function() {
            withDrawalDestination.val($(this).find(":checked").val());
        });
        withdrawalDetailsGenerator.on('click', () => {
        let clone = withdrawalDetails.clone();
        // SETTING VALUES IN INPUT FIELD
        clone.find('.detail_purpose').val('');
        clone.find('.hidden').remove();
        clone.find('.detail_amount').val('');
        clone.find('.detail_date').val(withdrawalDate.val());
        clone.find('.intermediate option:selected').removeAttr('selected');
        clone.find('.destination option:selected').removeAttr('selected');
        clone.find('.project option:selected').removeAttr('selected');
        clone.find('.category option:selected').removeAttr('selected');
        clone.insertBefore(withdrawalDetailsGenerator);
        // get the newly added select tag and attach onchange event listener
        let withDrawalIntermidiate = clone.find('.intermediate');
        let withDrawalDestination = clone.find('.destination');
            withDrawalIntermidiate.on('change', function() {
                withDrawalDestination.val($(this).find(":checked").val());
            });
        });

        // SETTING DEFAULT ACCOUNT USED
        let accountUsed =   $('#account_used');
        if((accountUsed.find('option:selected')).val()    ===  ""){
            $('#account_used option[value="1"]').prop('selected', true);
        };

        // SETTING TAB ON DATE
        $('input[type=date]').keydown(function(e) {
            if (e.key === "Tab") {
                e.preventDefault();
                var inputs = $(this).closest('form').find(':input:not(:disabled)');
                var idx = inputs.index(this);
                var nextInput = inputs.eq(idx+1);
                while (nextInput.prop('tagName') === 'SELECT' || nextInput.prop('disabled') === true) {
                  idx = inputs.index(nextInput);
                  nextInput = inputs.eq(idx+1);
                }
                if (nextInput.length) {
                  nextInput.focus();
                }
              }
          });
    }
)