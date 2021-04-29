console.log("Hi?");

class Model{

    async getComments(){
        let response = await fetch('http://localhost/projects/assign4-thatoneguy-nogroup/api/getComments.php');
        let comments = await response.json();
        return comments;
    }

    async addComment(formData){
        const formDataText = Object.fromEntries(formData.entries());
        const formDataJSON = JSON.stringify(formDataText);
        console.log(formDataJSON);

        const fetchOptions = {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: formDataJSON
        };

        const response = await fetch('http://localhost/projects/assign4-thatoneguy-nogroup/api/addComment.php',fetchOptions);
        const result = response.json();
        return result;
    }

}

class View{

    async renderTable(comments){
        let artID = document.getElementById("artID").value;
        let list = document.getElementById("comments-list");
        let view = "";
        let cnt = 0;

        comments.forEach(comment => {
            if(comment['artID'] == artID) {

                view = view + "<div class='card my-4'>" +
                    "<div class='card-body'>" +
                    "<h4>" + comment['authorName'] + " - <span class='text-info'>" + comment['lastModified'] + "</span>:</h4><br>" +
                    "<p class='card-text' style='font-size: 1.2rem'>" + comment['content'] + "</p></div>" +
                    "</div>";
                cnt++;
            }    
        });
        
        list.innerHTML=view;
        let message = document.getElementById('message');
        message.innerHTML = "Updated: " + new Date();
        
        let commentsNum = document.getElementById("comments-num");
        commentsNum.innerText = "" + cnt + " comments";
    }

}

class Controller{

   constructor(model,view){
        this.model=model;
        this.view=view;
        this.attachListeners();
   }

   attachListeners(){
       //Attach Listener to Refresh Button
        const button = document.getElementById('refresh');
        button.addEventListener("click", (event) => this.showComments());
        
        //Attach Listener to Form Submission
        if(document.getElementById('comment-form') != null) {
            const commentform = document.getElementById('comment-form');
            commentform.addEventListener('submit',(event) => this.handlerAddForm(event));
        }

        //Timed Refresh Comments Table
        setInterval( (event) => this.showComments(),5000);
   }

   async handlerAddForm(event){
        event.preventDefault();  //Prevent Normal HTTP Form Submisson and Page Refresh

        const form = event.currentTarget;
        const formData = new FormData(form);
        console.log("FormData:" + formData);
        const responseData = await this.model.addComment(formData);
        form.reset();
   }

   async showComments(){
       let comments = await this.model.getComments();
       await this.view.renderTable(comments);
   }
}

const controller = new Controller(new Model(),new View());
controller.showComments();


  