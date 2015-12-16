define(['jquery'], function ($) {
    return {
        readSingleFileAsText: function(e, callback){
            //Retrieve the first (and only!) File from the FileList object
            var file = e.target.files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = callback;
                reader.readAsText(file);
            }

            return false;
        }
    };
})