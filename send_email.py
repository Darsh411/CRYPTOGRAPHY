import smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

def send_email(to_address):
    from_address = "your-email@example.com"
    password = "your-email-password"

    # Create the email
    msg = MIMEMultipart('alternative')
    msg['Subject'] = "Immediate Action Required: Password Update"
    msg['From'] = from_address
    msg['To'] = to_address

    with open("email-template/phishing-email.html", "r") as file:
        html_content = file.read()

    msg.attach(MIMEText(html_content, 'html'))

    # Send the email
    with smtplib.SMTP_SSL('smtp.example.com', 465) as server:
        server.login(from_address, password)
        server.sendmail(from_address, to_address, msg.as_string())

if __name__ == "__main__":
    recipient = "recipient@example.com"
    send_email(recipient)
