<style>
    
    :root {
            --light-bg: #F0F3FA;
            --secondary-bg: #D5DEEF;
            --soft-accent: #8AAEE0;
            --light-blue: #B1C9EF;
            --primary-accent: #638ECB;
            --dark-text: #395886;
        }
    
        .navbar {
            background-color: white;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
        }
        
        @media (max-width: 700px){
          
          .navbar-right{
            gap: 1rem !important;
          }
          
          .guest-user{
            right: 105px !important;
          }

            .user-logged-in {
            right: 180px !important;
            width: 50px !important;
            height: 40px !important;
            top: 20px !important;
            }

            .navbar-toggler-icon {
                width: .8em !important;
                height: 1.2em !important;
            }
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary-accent);
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            margin-left: 30px;
        }
        
        .navbar-brand i {
            margin-right: 10px;
            font-size: 2rem;
        }
        
        .nav-link {
            color: var(--dark-text);
            font-weight: 500;
            margin: 0 8px;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--primary-accent);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover {
            color: var(--primary-accent);
        }
        
        .nav-link:hover:after {
            width: 100%;
        }
        
        .nav-link.active {
            color: var(--primary-accent);
        }
        
        .nav-link.active:after {
            width: 100%;
        }
        
        .btn-login {
            background-color: white;
            color: var(--primary-accent);
            border: 2px solid var(--primary-accent);
            border-radius: 30px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
  
  .btn-login-header{
    display: none;
  }
        
        .btn-login:hover {
            background-color: var(--primary-accent);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .btn-register {
            background-color: var(--primary-accent);
            color: white;
            border-radius: 30px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: none;
        }
        
        .btn-register:hover {
            background-color: var(--dark-text);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
  
  		@media (max-width: 1500px) {
				.profile-icon-name {
                    display: none !important;
                }
  			}
          
        @media (min-width: 1400px) {
            .container, .container-lg, .container-md, .container-sm, .container-xl {
                max-width: 95vw !important;
            }

            .register-media {
                display: block !important;
            }
        }

        @media (min-width: 1250px) {
            .navbar-brand{
                font-size: 1.4rem;
            }
        }   
            
        @media (min-width: 1200px) {
            .container{
                max-width: 97vw;
            }

            .btn-login-header{
                display: block !important;
            }
        }

        @media (max-width: 1350px) {
            .logout-button{
                display: none !important;
            }
        }
  
  		@media (max-width: 1200px) {
          .header-container{
        	max-width: 100vw !important;  
          }
  		}	

        @media (max-width: 1150px) {
            .navbar-expand-lg {
                flex-wrap: wrap;
            }
            .navbar-expand-lg .navbar-collapse {
                display: none !important;
            }
            .navbar-expand-lg .navbar-toggler {
                display: block;
            }

            button.navbar-toggler {
                position: absolute;
                right: 125px;
                top: 24px;
            }

            .user-logged-in {
                right: 195px !important;
            }
            }

        .navbar-expand-lg .navbar-collapse.show {
            display: flex !important;
            flex-basis: 100%;
        }

        @media (max-width: 600px) {
            .login-media {
                display: none !important;
            }
          
          .logo-name {
                display: none !important;
            }

            .user-logged-in {
                right: 175px !important;
            }

            .profile-icon-name{
                display: none !important;
            }
        }

        @media (max-width: 450px) {

            .navbar-brand .logo {
                font-size: 1.8rem !important;
            }

            .user-logged-in {
                right: 155px !important;
            }
          
          .fs-5 {
              font-size: 1rem !important;
          }
          
          .guest-user{
            right: 80px !important;
          }
                    
          .navbar-right {
            gap: .7rem !important;
          }

            .header-container {
                padding: 0 !important;
            }

            .navbar-brand {
                font-size: 1.2rem !important;
                margin-left: 30px !important;
            }

        }
  
        @media (max-width: 400px){
          .navbar-brand {
                font-size: 1.2rem !important;
            }

          .header-container{
           	padding-x: 0px !important; 
          }
          
          .guest-logo-name{
            font-size: 1.1rem !important;
          }
          
          .guest-navbar-brand {
        		margin-left: 15px !important;
    		}
        }

        .navbar-collapse.show + .navbar-right {
            position: absolute;
            top: 16px;
            right: 0px;
        }

        .dropdown-submenu {
        position: relative;
        }

        .dropdown-submenu .dropdown-menu {
        top: 0;
        right: 150px;
        margin-left: 0.1rem;
        }

        .profile-dropdown {
            cursor: pointer;
        }

        .profile-img {
            width: 50px;          
            height: 50px;
            object-fit: cover;    
            border: 2px solid #fff; 
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .profile-img:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
        }

        .profile-icon-name {
            font-weight: 500;
            font-size: 0.95rem;
            color: #333;
        }
</style>