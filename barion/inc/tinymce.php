<script type="text/javascript" src="/admin/tinymce/js/tinymce/tinymce.min.js"></script>

<script type="text/javascript">

tinymce.init({

  selector: 'textarea',

  height: 500,

  theme: 'modern',

  language : 'cs',

  forced_root_block : "",

  entity_encoding: "raw",

  relative_urls: false,

  fontsize_formats: "10px 12px 14px 16px 18px 24px 36px",

  plugins: [

    'advlist autolink lists link image charmap print preview hr anchor pagebreak',

    'searchreplace wordcount visualblocks visualchars code fullscreen',

    'insertdatetime media nonbreaking save table contextmenu directionality',

    'emoticons template paste textcolor colorpicker textpattern imagetools'

  ],

 
  toolbar1: 'insertfile undo redo | styleselect | bold italic | fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons',


  image_advtab: true,

  templates: [

    { title: 'Test template 1', content: 'Test 1' },

    { title: 'Test template 2', content: 'Test 2' }

  ],

  content_css: [

    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',

    '//www.tinymce.com/css/codepen.min.css'

  ]

 });

</script>