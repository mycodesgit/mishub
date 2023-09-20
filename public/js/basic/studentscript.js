$(document).ready(function() {
    function generatePassword() {
        var digits = String(Math.floor(Math.random() * 10000)).padStart(4, '0'); 
        var suffix = ['K', 'U', 'G']; 
        var char = suffix[Math.floor(Math.random() * suffix.length)]; 
        return digits + char;
    }

    $('#generatePassword').click(function() {
        var generatedPassword = generatePassword();
        $('#passwordInput').val(generatedPassword); 
    });
});