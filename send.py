import smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

# SMTP configuration
SMTP_HOST = 'smtp.cdac.in'
SMTP_PORT = 587
SMTP_USER = 'sci-expo@cdac.in'
SMTP_PASS = 'CdacblR12!@3456789'

# Email details
FROM_EMAIL = 'sci-expo@cdac.in'
FROM_NAME = 'Super Computing India 2025'
TO_EMAIL = 'manish.sharma@interlinks.in'  # Replace with actual recipient
SUBJECT = 'Welcome to Super Computing India 2025'
HTML_BODY = """
<html>
  <body>
    <h2>Welcome!</h2>
    <p>Thank you for registering for <strong>Super Computing India 2025</strong>.</p>
  </body>
</html>
"""

# Create message
msg = MIMEMultipart()
msg['From'] = "{} <{}>".format(FROM_NAME, FROM_EMAIL)
msg['To'] = TO_EMAIL
msg['Subject'] = SUBJECT
msg.attach(MIMEText(HTML_BODY, 'html'))

# Send email
try:
    server = smtplib.SMTP(SMTP_HOST, SMTP_PORT)
    server.ehlo()
    server.starttls()
    server.login(SMTP_USER, SMTP_PASS)
    server.sendmail(FROM_EMAIL, TO_EMAIL, msg.as_string())
    server.quit()
    print("Email sent successfully.")
except Exception as e:
    print("Failed to send email: {}".format(str(e)))