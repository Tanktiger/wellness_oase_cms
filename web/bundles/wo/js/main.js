tinymce.init({
    selector: ".editable",
    inline: true,
    content_css : "/bundles/wo/semantic/css/semantic.min.css",
    language: 'de',
    plugins: [
        "advlist autolink link image lists charmap hr anchor pagebreak spellchecker",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons paste textcolor"
    ],
    //TODO: Menubar entfernen damit nur noch toolbar da ist
    toolbar: "save | insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | addelements | forecolor backcolor emoticons",
    setup: function(editor) {
        editor.addButton('addelements', {
            type: 'menubutton',
            text: 'Elemente',
            icon: false,
            menu: [
                {text: 'Menu item 1', onclick: function() {editor.insertContent('Menu item 1');}},
                {text: 'Menu item 2', onclick: function() {editor.insertContent('Menu item 2');}}
            ]
        });
        //editor.addButton('save', {
        //    text: 'Speichern',
        //    icon: false,
        //    onclick: function() {
        //        editor.insertContent('Main button');
        //    }
        //});
    }
});