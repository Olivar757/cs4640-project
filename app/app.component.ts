import { Component } from '@angular/core';
import { Order } from './order';
import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';
import { LEADING_TRIVIA_CHARS } from '@angular/compiler/src/render3/view/template';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {

  // dependency injection 
  constructor(private http: HttpClient) { }

  title = 'Contact Us';
  author = 'Natalie Novkovic, Noah Dela Rosa';

  reasons = ["Issues with login/signup", "Reset username/password", "Recipe Request", "Change to Recipe", "Other"]

  confirm_msg = '';
  data_submitted = '';
  has_clicked = false;

  /* create an instance of an Order, assuming there is an existent order */
  /* we will bind orderModel to the form, allowing an update / delete transaction */
  /* orderModel = new Order('duh', 'duh@uva.edu', 1112223333, '', '', true); */
  orderModel = new Order('', '', '', '');

  getfromdb(form: any):void{
    this.data_submitted = form;
    let params = JSON.stringify(form);
    this.http.post<void>('http://localhost/db.php', params).subscribe();
  }

  confirmOrder(data: any): void {
     console.log(data);
     this.confirm_msg = 'Thank you, ' + data.name + " your message was received, we'll follow-up with you as soon as possible!";
  }

  responsedata = new Order('', '', '', '');
  // passing in a form variable of type any, no return result
  onSubmit(form: any): void {
    this.has_clicked = true;
     console.log('You submitted value: ', form);
     this.data_submitted = form;

     // console.log(this.data_submitted, this.data_submitted.name.length);
     console.log('form submitted ', form);

     // prepare to send a request to the backend PHP 
     //1. convert the form data to JSON format 
     let params = JSON.stringify(form);
     console.log(params);
     //2. send an HTTP request to the backend 
     //get request or post request 
    

     //send a POST request 
     //post<return_type>('url', data )
     this.http.post<Order>('http://localhost/ng-post.php', params) 
     .subscribe((response_from_php) => { 
       //successfully, use response in some way
       this.responsedata = response_from_php; 
       console.log('response data', this.responsedata);
     }, (error_in_comm) => { 
       //error occurs, handle it in some way
        console.log('Error occurs ', error_in_comm);
     })

     this.http.post<void>('http://localhost/db.php', params).subscribe((response_from_php) => {},
      (error_in_comm) => { 
        console.log('Error occurs ', error_in_comm);
    })
  }

}
