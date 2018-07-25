function Validation(stringTarget){

    // this.emailRegex = new RegExp('^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$','g')
    this.emailRegex = new RegExp('^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$','g')
    this.phoneRegexID = new RegExp(/\(?(?:\+62|62|0)(?:\d{2,3})?\)?[ .-]?\d{2,4}[ .-]?\d{2,4}[ .-]?\d{2,4}/,'g')

    this.stringTarget = stringTarget

    this.emailValidation = function(){
        if(this.stringTarget.match(this.emailRegex)){
            return true
        }
        else{
            return false
        }
    }

    this.phoneValidation = function(){
        if(this.stringTarget.match(this.phoneRegexID)){
            return true
        }
        else{
            return false
        }
    }

    return this;
}