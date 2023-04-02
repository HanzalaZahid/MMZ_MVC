$(document).ready(function() {
    let locationSet =   false;
    let nameField = $('#project_name');
    let locationField = $('#location');
    let clientField = $('#client');
    let cityField = $('#city');
    locationField.on('change', function() {
        locationSet    =   true;
        let _location = locationField.val();
        let _client = $('#client option:selected').text();
        let _city = $('#city option:selected').text();
        // parsing client name
        let client  =   _client.split(" - ")[0].trim();
        // parsing city
        let city    =   _city.trim();
        // parsing location
        let location = _location.trim();

        let _projectName    =   client+" "+location+" "+city;
        nameField.val(_projectName);
    });
    clientField.on('change', function() {
        if (locationSet){
            let _location = locationField.val();
            let _client = $('#client option:selected').text();
            let _city = $('#city option:selected').text();
            // parsing client name
            let client  =   _client.split(" - ")[0].trim();
            // parsing city
            let city    =   _city.trim();
            // parsing location
            let location = _location.trim();
    
            let _projectName    =   client+" "+location+" "+city;
            nameField.val(_projectName);
        }
    });
    cityField.on('change', function() {
        if (locationSet){
            let _location = locationField.val();
            let _client = $('#client option:selected').text();
            let _city = $('#city option:selected').text();
            // parsing client name
            let client  =   _client.split(" - ")[0].trim();
            // parsing city
            let city    =   _city.trim();
            // parsing location
            let location = _location.trim();
    
            let _projectName    =   client+" "+location+" "+city;
            nameField.val(_projectName);
        }
    });
});
