# crear instancia


resource "aws_security_group" "building_security_group" {
  vpc_id = aws_vpc.building_vpc.id

  egress {
    from_port   = 80
    to_port     = 80
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }

  egress {
    from_port   = 22
    to_port     = 22
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }

  ingress {
    from_port   = 0
    to_port     = 0
    protocol   = "-1"
    cidr_blocks = ["0.0.0.0/0"]
  }

  tags = {
    Name = "building_permitir_http_ssh"
  }

}


resource "aws_instance" "building_web" {
  ami           = "ami-005fc0f236362e99f"
  instance_type = "t2.micro"

  network_interface {
    network_interface_id = aws_network_interface.building_instance_interface.id
    device_index         = 0
  }



  user_data = <<-EOF
                #!/bin/bash   
                printf "%s" "${file("building_web.key.pub")}" > /home/ubuntu/.ssh/authorized_keys
                sudo apt update
                sudo apt install nginx -y
                sudo systemctl enable nginx
                sudo mkdir -p /var/www/html
                sudo chown -R www-data:www-data /var/www/html
                sudo chmod -R 755 /var/www/html
                sudo systemctl restart nginx
                EOF


  tags = {
    Name = "buildindg_web"
  }
}

resource "aws_network_interface" "building_instance_interface" {
  subnet_id       = aws_subnet.public_building_subnet.id
  private_ips     = ["10.0.100.50"]
  security_groups = [aws_security_group.building_security_group.id]

}

resource "aws_key_pair" "building-ssh-key" {
  key_name   = "building-ssh-key"
  public_key = "building-ssh-key.pub"
}




