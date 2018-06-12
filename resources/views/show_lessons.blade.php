<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body onload="getLessons()">
    <div id="inputForm" >  
        <form action="#" method="POST"  id="saveLesson" name="lessonsForm">  
            <div class="inputItems">
                <label> Lesson Name:</label>
                <input type="text" name="lessonName">
            </div> 
            
            <div class="inputItems">
                <label> Lesson Description:</label>
                <textarea name="lessonDescription"></textarea>
            </div>  

            <div  class="inputButton">
                <button type="button" onclick="hideInputForm()" > Cancel</button>
                <button type="submit" >Add Lesson</button>
            </div>
        </form>
    </div>
    <div id ="allLessons"></div>

    <div id ="updateForm">
        <form action="#" method="POST"  id="saveLesson" name="updateForm1">  
                <div class="inputItems">
                    <label> Lesson Name:</label>
                    <input type="text" name="lessonName">
                </div> 
                
                <div class="inputItems">
                    <label> Lesson Description:</label>
                    <textarea name="lessonDescription"></textarea>
                </div>  

                <div  class="inputButton">
                    <button type="button" onclick="hideInputForm()" > Cancel</button>
                    <button type="submit"  onclick ="submitNewLesson()">Add Lesson</button>
                </div>
        </form>
    
    </div>
<script type="text/javascript">
    var methods = ["GET", "POST"];
    var baseUrl = "http://localhost:8000/";

    function createObject(readyStateFunction, requestMethod, requestUrl,  )
    {
        var obj = new  XMLHttpRequest();
        obj.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                readyStateFunction(this.responseText);
            }
        };
        obj.open(requestMethod, requestUrl, true )
        obj.send();
    }

    function displayLessons(jsonResponse)
    {

        var responseObj = JSON.parse(jsonResponse);
        var tData, count=0; 
        // var '<button type = 'button' onclick='showInputForm()> show Lesson</button>';
        var tableData ="<button type = 'button' onclick='showInputForm()'> show Lesson</button><table border = '1'><tr> <th>ID</th><th>Name</th><th>Description</th><th  colspan ='3'>Action</th></tr>";
        for(tData in responseObj)
        {
            count++;
            tableData+= "<tr><td>" + count +"</td>";
            tableData+= "<td>" + responseObj[tData].name +"</td>";
            tableData+= "<td>" + responseObj[tData].description +"</td>";
            tableData+= "<td> <a href = '#' onclick ='showLesson("+responseObj[tData].id+")'> View</a></td>";
            tableData+= "<td> <a href = '#' onclick = 'updateLesson("+responseObj[tData].id+", \""+responseObj[tData].name+"\", \""+responseObj[tData].description+"\" )'> Edit</a></td>";
            tableData+= "<td> <a href = '#' onclick ='deleteLesson("+responseObj[tData].id+", \""+responseObj[tData].name+"\" )'> Delete</a></td></tr>";

        }
        tableData+="</table>";
        document.getElementById("allLessons").innerHTML= tableData;
    }

    function getLessons()
    {
        createObject(displayLessons, methods[0], baseUrl + "getLesson");
        document.getElementById("inputForm").style.display="none";
        document.getElementById("updateForm").style.display="none";
        
    }

    function submitLesson()
    {   //get lesson
            var lessonName = document.forms["lessonsForm"]["lessonName"].value;
            var lessonDescription = document.forms["lessonsForm"]["lessonDescription"].value;

            // alert(lessonName+lessonDescription);
        //validate
        if((lessonName != "") && (lessonDescription != ""))
        {
            createObject(getLessons, methods[1], baseUrl +" saveLesson"); 
        }
        else
        {
            // alert("invalid input");
        }
        //send to server
        document.getElementById("saveLesson").addEventListener("submit", submitLesson);
    }
    function showLesson(id)
    {
        createObject(displaySingleLesson, methods[0], baseUrl +"getSingleLesson/"+id); 
        return false;
    }
    function updateLesson(id, name, description)
    {
        document.getElementById("updateForm").style.display="block";
        document.getElementById("allLessons").style.display="none";
        //get updatelesson
        document.forms["updateForm1"]["lessonName"].value = name;
        document.forms["updateForm1"]["lessonDescription"].value = description;
    }

    function displaySingleLesson(jsonResponse)
    {
        var responseObj2 = JSON.parse(jsonResponse);
        // var tableData ="<button type = 'button' onclick='showInputForm()'> show Lesson</button>";
        var htmlString= "<h1>" + responseObj2.name +"</h1>" + "<p>" + responseObj2.description +"</p>"+"<button type='button' onclick='getLessons()'>Go Back</button>";

        document.getElementById("allLessons").innerHTML= htmlString;
    }

    function showInputForm()
    {
        document.getElementById("inputForm").style.display="block";
        document.getElementById("allLessons").style.display="none";
    }

    function hideInputForm()
    {
        document.getElementById("inputForm").style.display="none";
        document.getElementById("allLessons").style.display="block";
        document.getElementById("updateForm").style.display="none";
    }
    function submitNewLesson() 
    {
        //get lesson
        var lessonName = document.forms["updateForm1"]["lessonName"].value;
        var lessonDescription = document.forms["updateForm1"]["lessonDescription"].value;

            // alert(lessonName+lessonDescription);
        //validate
        if((lessonName != "") && (lessonDescription != ""))
        {
            createObject(getLessons, methods[1], baseUrl +"updateLesson"); 
        }
        else
        {
            alert("invalid input");
        }
        
    }
    function deleteLesson(id, name)
    {   var text;
        if(confirm( "Do you want to delete a lesson?"))
        {
            text = "You are pressed ok";
            createObject(getLessons, methods[0], baseUrl +"deleteLesson/"+id); 
            
        }
        else
        {
            text = "You are pressed cancel"
        }
        return false;
        
    }


</script>
</body>
</html>