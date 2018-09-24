@extends("layouts.master")
@section("content")
<div id="inputForm" >
	<form action="#" method="POST"  id="saveLesson" name="lessonsForm" >
		@csrf
		<div class="inputItems">
			<label> Lesson Name:</label>
			<input class= "form-control" type="text" name="lessonName" required>
		</div>
		<div class="inputItems">
			<label> Lesson Description:</label>
			<textarea class= "form-control" name="lessonDescription" required></textarea>
		</div>
		<div  class="inputButton">
			<button  class="btn btn-warning " type="button" onclick="hideInputForm()" > Cancel</button>
			<button   class="btn btn-primary "type="submit">Add Lesson</button>
		</div>
	</form>
</div>

<div id ="allLessons"></div>
<div id ="archives"></div>

<div id ="updateForm">
	<form  class = "form-horizontal" action="#" method="POST"  id="updateLesson" name="updateForm1" >

	@csrf

	<div class="inputItems">
			<input class= "form-control" type="hidden" name="lessonId" required>
		</div>

		<div class="inputItems">
			<label> Lesson Name:</label>
			<input class= "form-control" type="text" name="lessonName" required>
		</div>

		<div class="inputItems">
			<label> Lesson Description:</label>
			<textarea  class= "form-control" name="lessonDescription" required></textarea>
		</div>

		<div  class="inputButton">
			<button class="btn btn-warning " type="button" onclick="hideInputForm()" > Cancel</button>
			<button  class="btn btn-primary " type="submit" >Update Lesson</button>
		</div>

	</form>
</div>
<script type="text/javascript">
	var methods = ["GET", "POST"];
	var baseUrl = "http://localhost:8000/";
	
	function createObject(readyStateFunction, requestMethod, requestUrl, sendData=null )
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
			if(requestMethod=='POST')
			{
				obj.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				obj.setRequestHeader("X-CSRF-token",  document.querySelector('meta[name = "csrf-token"]').getAttribute('content'));    
				obj.send(sendData);
			}
			else
			{
				obj.send();
			}
	 
	}
	
	function displayLessons(jsonResponse)
	{
	
	    var responseObj = JSON.parse(jsonResponse);
	    var tData, count=0; 
	    // var '<button type = 'button' onclick='showInputForm()> show Lesson</button>';
	    var tableData ="<button  class= 'btn btn-primary' type = 'button' onclick='showInputForm()'> Add Lesson</button><table class ='table table-bordered table-striped table-condensed'><tr> <th>ID</th><th>Name</th><th>Description</th><th  colspan ='4'>Action</th></tr>";
	    for(tData in responseObj)
	    {
	        count++;
	        tableData+= "<tr><td>" + count +"</td>";
	        tableData+= "<td>" + responseObj[tData].name +"</td>";
	        tableData+= "<td>" + responseObj[tData].description +"</td>";
	        tableData+= "<td> <a href = '#' class= 'btn btn-info btn-sm' onclick ='showLesson("+responseObj[tData].id+")'> View</a></td>";
	        tableData+= "<td> <a href = '#' class= 'btn btn-success btn-sm' onclick = 'updateLesson("+responseObj[tData].id+", \""+responseObj[tData].name+"\", \""+responseObj[tData].description+"\" )'> Edit</a></td>";
	        tableData+= "<td> <a href = '#' class= 'btn btn-danger btn-sm' onclick ='deleteLesson("+responseObj[tData].id+", \""+responseObj[tData].name+"\" )'> Delete</a></td>";
	        tableData+= "<td> <a href = '#' class= 'btn btn-info btn-sm' onclick ='viewUnits("+responseObj[tData].id+")'>Units</a></td> </tr>";

	    }
	    tableData+="</table>";
	    document.getElementById("allLessons").innerHTML= tableData;
	}
	
	function getLessons()
	{
	    createObject(displayLessons, methods[0], baseUrl + "getLesson");
	    document.getElementById("inputForm").style.display="none";
	    document.getElementById("updateForm").style.display="none";
		document.getElementById("allLessons").style.display="block";
	    
	}
	
	function submitLesson(e)
	{   //get lessonault 
		e.preventDefault();
		var lessonName = document.forms["lessonsForm"]["lessonName"].value;
		var lessonDescription = document.forms["lessonsForm"]["lessonDescription"].value;

		// alert(lessonName+lessonDescription);
	    //validate
	    if((lessonName != "") && (lessonDescription != ""))
	    {
			var sendData = "name="+lessonName+"&description=" +lessonDescription;
			console.log(sendData);
	        createObject(getLessons, methods[1], baseUrl+ "saveLesson", sendData);
	    }
	}

	function showLesson(id)
	{
	    createObject(displaySingleLesson, methods[0], baseUrl+"getSingleLesson/"+id); 
	    return false;
	}

	function updateLesson(id, name, description)
	{
	    document.getElementById("updateForm").style.display="block";
	    document.getElementById("allLessons").style.display="none";
	    //get updatelesson
	    document.forms["updateForm1"]["lessonName"].value = name;
	    document.forms["updateForm1"]["lessonDescription"].value = description;
		document.forms["updateForm1"]["lessonId"].value = id;
	}

	function updateLesson2(e)
	{
		e.preventDefault();
		var lessonName = document.forms["updateForm1"]["lessonName"].value;
	    var lessonDescription = document.forms["updateForm1"]["lessonDescription"].value;
		var lessonId = document.forms["updateForm1"]["lessonId"].value;

		var sendData = "name="+lessonName+"&description=" +lessonDescription+"&id=" +lessonId;
			console.log(sendData);
	        createObject(getLessons, methods[1], baseUrl+"updateLesson", sendData); 
	}
	
	function displaySingleLesson(jsonResponse)
	{
	    var responseObj2 = JSON.parse(jsonResponse);
	    // var tableData ="<button type = 'button' onclick='showInputForm()'> show Lesson</button>";
	    var htmlString= "<h1>" + responseObj2.name +"</h1>" + "<p>" + responseObj2.description +"</p>"+"<button class= 'btn btn-warning ' type='button' onclick='getLessons()'>Go Back</button>";
	
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
	    if(confirm( "Do you want to delete" + " "+name + "?"))
	    {
	        text = "You are pressed ok";
	        createObject(getLessons, methods[0], baseUrl +"deleteLesson/"+id); 
	        alert("You have deleted" + " "+name );
	    }
	    else
	    {
	        text = "You are pressed cancel"
	    }
	    return false;

	
	    
	}
	function viewLessonUnit(jsonResponse)
	{
		var responseObj = JSON.parse(jsonResponse);
	    var tData, count=0; 
	  	var tableData ="<table class ='table table-bordered table-striped table-condensed'><tr> <th>ID</th><th>Name</th><th>Hours</th><th  colspan ='4'>Action</th></tr>";
	    for(tData in responseObj)
	    {
	        // count++;
	        // tableData+= "<tr><td>" + count +"</td>";
	        tableData+= "<tr><td>" + responseObj[tData].name +"</td>";
	        tableData+= "<td>" + responseObj[tData].hours +"</td>";
	        tableData+= "<td> <a href = '#' class= 'btn btn-info btn-sm' onclick ='viewLecturer("+responseObj[tData].units_id+")'> Lecturer</a></td>";
	        tableData+= "<td> <a href = '#' class= 'btn btn-success btn-sm' onclick = 'updateLesson("+responseObj[tData].id+", \""+responseObj[tData].name+"\", \""+responseObj[tData].description+"\" )'> Edit</a></td>";
	        tableData+= "<td> <a href = '#' class= 'btn btn-danger btn-sm' onclick ='deleteLesson("+responseObj[tData].id+", \""+responseObj[tData].name+"\" )'> Delete</a></td>";
	        tableData+= "<td> <a href = '#' class= 'btn btn-info btn-sm' onclick ='getLessons("+responseObj[tData].id+")'>Back</a></td> </tr>";

	    }
	    tableData+="</table>";
	    document.getElementById("allLessons").innerHTML= tableData;
	}

	function viewUnits(lesson_id)
	{
		createObject(viewLessonUnit, methods[0], baseUrl + "getUnits/"+lesson_id);
	}

	function viewLecturer(lecturer_id)
	{
		createObject(viewLecturer2, methods[0], baseUrl + "getLecturer/"+lecturer_id);
	}

	function viewLecturer2(jsonResponse)
	{
		var responseObj = JSON.parse(jsonResponse);
	    var tData, count=0; 
	  	var tableData ="<table class ='table table-bordered table-striped table-condensed'><tr> <th>ID</th><th>Name</th><th>Hours</th><th  colspan ='4'>Action</th></tr>";

	        // count++;
	        // tableData+= "<tr><td>" + count +"</td>";
	        tableData+= "<tr><td>" + responseObj.lecturer_name +"</td>";
	        tableData+= "<td>" + responseObj.telephone +"</td>";
	        tableData+= "<td> <a href = '#' class= 'btn btn-info btn-sm' onclick ='viewLecturer("+responseObj.id+")'> Lecturer</a></td>";
	        tableData+= "<td> <a href = '#' class= 'btn btn-success btn-sm' onclick = 'updateLesson("+responseObj.id+", \""+responseObj.name+"\", \""+responseObj.description+"\" )'> Edit</a></td>";
	        tableData+= "<td> <a href = '#' class= 'btn btn-danger btn-sm' onclick ='deleteLesson("+responseObj.id+", \""+responseObj.name+"\" )'> Delete</a></td>";
	        tableData+= "<td> <a href = '#' class= 'btn btn-info btn-sm' onclick ='getLessons("+responseObj.id+")'>Back</a></td> </tr>";

	  
	    tableData+="</table>";
	    document.getElementById("allLessons").innerHTML= tableData;
	}
	document.getElementById("saveLesson").addEventListener("submit", submitLesson);
	document.getElementById("updateLesson").addEventListener("submit", updateLesson2);
	
</script>
@endsection