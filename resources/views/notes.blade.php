<html><head>
    <title>Note-to-myself : notes</title>
    <link rel="shortcut icon" href="/images/pencil.ico" />
    <script type="text/javascript">
        function openInNew(textbox){
            window.open(textbox.value);
            this.blur();
        }
    </script>


    <link href="/css/notes.css" rel="stylesheet" type="text/css" media="screen" />



</head>
<body>

<div id="wrapper">
    <form action="notes.php" enctype="multipart/form-data" method="post">
        <h2 id="header">{{Auth::user()->email}} - <span><a href="{{route('logout')}}">Log out</a></span></h2>


        <div id="section1">

            <div id="column1">
                <h2>notes</h2>
                <textarea cols="16" rows="40" id="notes" name="notes" />adsfdsa</textarea>
            </div>

            <div id="column2">
                <h2>websites</h2><h3>click to open</h3>

                <input type='text' name='websites[]' value='ovcmt.app' onclick='openInNew(this);' /><br >

                <input type="text" name="websites[]" /><br >
                <input type="text" name="websites[]" /><br >
                <input type="text" name="websites[]" /><br >
                <input type="text" name="websites[]" /><br >

            </div>

        </div>

        <div id="section2">

            <div id="column3">
                <h2>images</h2><h3>click for full size</h3>
                <!-- <textarea cols="16" rows="40" id="image" name="image" /></textarea> -->

                <input type="file" name="i" /><br /><br />


                <div>

                    <a href='uploadedimages/li.matthew.m@gmail.com/1490914525a3283728899_10.jpg' target='_blank'><img src='uploadedimages/li.matthew.m@gmail.com/thumb_1490914525a3283728899_10.jpg' alt='1490914525a3283728899_10.jpg'  /></a> <input type='checkbox' name='delete[]' value='409' /> <label for='delete[]'>delete</label><br /><br />
                </div>



            </div>

            <div id="column4">
                <h2>tbd</h2>
                <textarea cols="16" rows="40" id="tbd" name="tbd" />asdf</textarea>
            </div>

        </div>

        <div id="footer">
            <input type="submit" value="Save" style="width:200px;height:80px" name="submitting" />
        </div>

</div>

</body>
</html>