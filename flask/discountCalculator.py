from flask import Flask, request, render_template
from datetime import date

app = Flask(__name__)

# With no input
@app.route('/')
def main():
    return 'Hello, World!'

# Example: http://127.0.0.1:5000/api/discountCalculator?regDate=2017-01-21&fee=5000
@app.route('/api/discountCalculator')
def discount():
    regDate = request.args.get('regDate')
    fee = request.args.get('fee')

    # trim the date and convert into int for calculation
    regDate = int(regDate[:4])

    # get date today
    today = str(date.today())
    today = int(today[:4])

    # date calculation
    YearOfHoldingAccount = (today - regDate)

    # literally means no discount if it 
    # does not satify any of these conditions
    discount = 1
    if YearOfHoldingAccount > 3:
        discount = .7
    elif YearOfHoldingAccount > 2:
        discount = .8
    elif YearOfHoldingAccount > 1:
        discount = .9

    # calculating the discount
    fee = float(fee) * float(discount)
    return str(fee) 

if __name__=="__main__":
    app.run(debug=True)