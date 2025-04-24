Project Title: Scalable PHP Web Application Deployment Using AWS Infrastructure and Boto3

Objective

Deploy a scalable PHP-based user registration web application using AWS services and automate the entire cloud infrastructure setup via Python's Boto3 SDK. The architecture uses a VPC with public and private subnets, ALB, EC2 (Auto Scaling Group), RDS (MySQL), NAT Gateway, and an SNS topic for notifications.

Tools and Services Used

```
+---------------------------------------------+
|                Python Boto3                |
|        (Infrastructure as Code)            |
+---------------------------------------------+
                 │
                 ▼
+---------------------------------------------+
|        Amazon VPC & Networking              |
| (Subnets, Route Tables, IGW, NAT Gateway)  |
+---------------------------------------------+
                 │
                 ▼
+---------------------------------------------+
|         Security Groups Configuration       |
+---------------------------------------------+
                 │
                 ▼
+---------------------------------------------+
|       Amazon RDS (MySQL - Multi-AZ)         |
+---------------------------------------------+
                 ▲
                 │
+---------------------------------------------+
|         EC2 Auto Scaling Group              |
|    (Launch Template + UserData script)     |
+---------------------------------------------+
                 │
                 ▼
+---------------------------------------------+
|             Application Load Balancer       |
+---------------------------------------------+
                 │
                 ▼
+---------------------------------------------+
|          Amazon SNS (Notification)         |
+---------------------------------------------+
```

File/Script Structure

1. Configuration Section

```
REGION = 'ap-south-1'
AMI_ID = 'ami-0e35ddab05955cf57'
KEY_NAME = 'akashsridhar'
ZIP_URL = 'https://raw.githubusercontent.com/AKASH8525/new/main/php_registration_app.zip'
DB_NAME = 'userdb'
DB_USER = 'admin'
DB_PASSWORD = 'Admin12345'
SNS_EMAIL = 'akashak052004@gmail.com'
SNS_TOPIC_NAME = 'asg-notifications'
```

These are global constants that control your AWS region, image, keys, app source, database credentials, and notification details.

2. Logging and AWS Client Setup

```
logging.basicConfig(level=logging.INFO, format='%(levelname)s: %(message)s')
```

Logs script events. Clients are initialized for EC2, RDS, ELB, Auto Scaling, and SNS.

3. VPC and Networking Setup

```
def create_network():
```

This function:

- Creates a VPC with DNS support
- Creates an Internet Gateway
- Creates 6 subnets: 2 public, 2 private for EC2, 2 private for RDS
- Allocates Elastic IP and creates NAT Gateway in a public subnet
- Configures route tables for public and private subnets

 4. Security Group Setup

```
def create_security_groups():
```

This function creates and configures the following security groups:

- ALB-SG: HTTP access from anywhere
- EC2-SG: Allows HTTP from ALB and SSH from Bastion
- RDS-SG: Allows MySQL from EC2
- Bastion-SG: Allows SSH from anywhere

 5. RDS Setup

```
def create_rds():
```

This creates a MySQL RDS DB instance in a Multi-AZ setup:

- 20GB storage
- db.t3.micro instance type
- Private subnets used via a DB subnet group
- Uses the previously created RDS-SG security group

Returns the DB Endpoint, which is used by EC2 for app connectivity.

6. EC2 Launch Template

```
def create_launch_template(db_endpoint):
```

Creates a launch template with User Data script that:

- Installs Apache, PHP, MySQL client
- Downloads and unzips PHP registration app from ZIP_URL
- Updates database connection in the PHP code using the RDS endpoint


Notifications

- An SNS Topic is created and subscribed to the given email.
- The Auto Scaling Group is configured to send notifications (e.g., launch/terminate events) to the topic.

Access Management

- All security groups are strictly defined by role-based access.
- Bastion is deployed in the public subnet to allow SSH into private EC2 instances (if needed).

 Key Benefits

- Fully automated infrastructure setup using Boto3.
- Scalable and Highly Available.
- Easy to replicate and modify.



Maintained by: Akash K

GitHub Repository: https://github.com/AKASH8525/AKASH_PROJECTS.git

