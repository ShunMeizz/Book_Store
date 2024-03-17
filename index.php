<?php
     session_start();  
     include 'connect.php';

     $username_display = '';

     // Check if the user is logged in (has an active session)
      if(isset($_SESSION['acctID'])){
          $id = $_SESSION['acctID'];
          $query = "select * from tbluseraccount where acctID = '$id' limit 1";
          $result = mysqli_query($connection, $query);

          if($result && mysqli_num_rows($result) > 0 ){
            $user_data = mysqli_fetch_assoc($result);
            $username_display = $user_data['username'];
          }        
      }
     
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gaklat BookShop</title>
    <link rel="icon" type="image/x-icon" href="images/logo.png" />
    <link
      href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    <link rel="stylesheet" href="css/style1.css" />
    <link rel="stylesheet" href="css/style2.css" />
  </head>
  <body>
    <!--NAVIGATION BAR-->
    <div class="navigation_container">
      <img src="images/logo.png" class="logo" />
      <span class="logotext">Gaklat</span>
      
      <nav>
        <ul>
          <li><a href="#homeid">Home</a></li>
        </ul>
      </nav>
      <div class="search_container">
        <input type="text" class="search_bar" placeholder="Type to search..." />
        <button class="search_button">Search</button>
      </div>
        <a href="#yourcart" onclick="YourCartFunction()"><img src="images/addtocart_icon.png" class="icons" alt=""/></a>
        <a href="profilePage.php"><img src="images/user_icon.png" class="icons"/></a>
        <p class="username_display"><?php echo $username_display; ?></p>
      <a href="register.php" class="buttons button2">REGISTER</a>
      <a href="login.php" class="buttons button2">LOGIN</a>
    </div>
    <!--YOUR CART-->
    <div class="yourcart_container">
      <i class="fas fa-times"></i>
      <span class="text">User's Cart</span>
      <div class="yourcart_list">
        <div class="yourcart_products"></div>
      </div>
      <div class="yourcart_bottompart">
        <span class="total">Total</span>
        <a href="" class="checkout">CheckOut</a>
      </div>
    </div>
    <!--MAIN BAR-->
    <div class="mainbar_container">
      <!--LANDING PAGE-->
      <section id="homeid" class="home_container">
        <div class="welcome_content">
          <span class="subheader_text">FOR LIMITED TIME ONLY</span>
          <h2>FEATURE BOOKS OF THE MONTH</h2>
          <span class="normaltext"
            >Lorem ipsum dolor sit amet consectur adipiscing elit. Magnam
            deserunt nostrum accusamus. Nam alias sit necessitabus, aliquid ex
            minima at.</span
          >
          <br /><br />
          <img src="images/awards.PNG" alt="" />
          <a href="#productid" class="buttons button2">BROWSE THE LIST</a>
          
        </div>
      </section>
      <!--ABOUT US PAGE-->
      <section id="aboutid" class="aboutpage_container">
        <div class="centertext">
          <p class="subheader_text">DISCOVER OUR COMPANY'S STORY</p>
          <p class="header_text">About Us</p>
        </div>
        <div class="aboutus-content">
          <img src="images/logo_w_noise.png" alt="" />
          <span class="normaltext"
            >Gaklat BookShop, a local gem in the heart of New York City, has
            been a haven for book lovers since its establishment in 2012. Known
            for its diverse collection, welcoming atmosphere, and commitment to
            promoting the love of reading, Gaklat has become a cherished
            destination for literary enthusiasts.</span
          >
        </div>
        <div class="aboutus-container2">
          <div class="aboutus-section">
            <div class="aboutus-cards">
              <div class="owners-card">
                <div class="image-section">
                  <img src="images/owners_karylle.png" alt="" />
                </div>
                <div class="owners-content">
                  <h2>Owner</h2>
                  <p class="normaltext">Mary Karylle Delos Reyes</p>
                  <!--<div class="quotebox">
                    <span class ="quotetext">"Books are not just collections of pages; they are portals to different worlds. As Co-Owner and Book Curator, I strive to create experiences that bring those worlds to life."</span>
                    </div>-->
                </div>
              </div>
              <div class="owners-card">
                <img src="images/owners_shanley.png" alt="" />
                <div class="owners-content">
                  <h2>Owner</h2>
                  <p class="normaltext">Shanley Mae Sebial</p>
                  <!--<div class="quotebox">
                      <span class ="quotetext">"At Gaklat Studio, we don't just create stories- we transport readers to new worlds and ignite imaginations with immersive reading experiences that they'll never forget."</span>
                      </div>-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--PRODUCTS PAGE-->
      <section id="productid" class="products_container">
        <div class="centertext">
          <p class="subheader_text">BUY BOOK NOW</p>
          <p class="header_text">Popular Series</p>
        </div>
        <div class="productlist_container">
          <div class="product" data-name="p-1">
            <img src="images/halfblood_book.png" alt="halfblood_book cover" />
            <div class="book-title">The Half-Blood Prince</div>
            <div class="author_date">J.K Rowling ∙2005</div>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
              <span>( 250 )</span>
            </div>
          </div>
          <div class="product" data-name="p-2">
            <img src="images/asong_book.png" alt="asong_book cover" />
            <div class="book-title">A Song of Ice & Fire</div>
            <div class="author_date">George R.R. Martin ∙2011</div>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
              <span>( 250 )</span>
            </div>
          </div>
          <div class="product" data-name="p-3">
            <img
              src="images/giftofbattle_book.png"
              alt="giftofbattle_book cover"
            />
            <div class="book-title">The Gift of Battle</div>
            <div class="author_date">Morgan Rice ∙2014</div>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
              <span>( 250 )</span>
            </div>
          </div>
          <div class="product" data-name="p-4">
            <img
              src="images/poseidonawake_book.png"
              alt="poseidonswake_book cover"
            />
            <div class="book-title">Poseidon's Wake</div>
            <div class="author_date">Alastair Reynolds ∙2015</div>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
              <span>( 250 )</span>
            </div>
          </div>
          <div class="product" data-name="p-5">
            <img
              src="images/deathlyhallows_book.png"
              alt="deathlyhallows_book cover"
            />
            <div class="book-title">The Deathly Hallows</div>
            <div class="author_date">J.K. Rowling ∙2007</div>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
              <span>( 250 )</span>
            </div>
          </div>
          <div class="product" data-name="p-6">
            <img
              src="images/gobletoffire_book.png"
              alt="gobletoffire_book cover"
            />
            <div class="book-title">The Goblet of Fire</div>
            <div class="author_date">J.K. Rowling ∙2005</div>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
              <span>( 250 )</span>
            </div>
          </div>
          <div class="product" data-name="p-7">
            <img
              src="images/stormofswords_book.png"
              alt="stormofswords_book cover"
            />
            <div class="book-title">A Storm of Swords</div>
            <div class="author_date">George R.R. Martin ∙2014</div>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
              <span>( 250 )</span>
            </div>
          </div>
          <div class="product" data-name="p-8">
            <img
              src="images/dancewdragons_book.png"
              alt="dancewdragons_book cover"
            />
            <div class="book-title">A Dance with Dragons</div>
            <div class="author_date">George R.R. Martin ∙2014</div>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
              <span>( 250 )</span>
            </div>
          </div>
          <div class="product" data-name="p-9">
            <img
              src="images/orderofphoenix_book.png"
              alt="Order of Phoenix cover"
            />
            <div class="book-title">Order of Phoenix</div>
            <div class="author_date">JK Rowling ∙2014</div>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
              <span>( 250 )</span>
            </div>
          </div>
          <div class="product" data-name="p-10">
            <img src="images/littlered.jpg" alt="Little Red Riding cover" />
            <div class="book-title">Little Red in Riding Hood</div>
            <div class="author_date">Jacob Grimm ∙2014</div>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
              <span>( 250 )</span>
            </div>
          </div>
        </div>
      </section>
    </div>
    <!--PRODUCTS PREVIEW DETAILS-->
    <div class="products-preview">
      <div class="preview" data-target="p-1">
        <i class="fas fa-times"></i>
        <img src="images/halfblood_book.png" alt="halfblood_book cover" />
        <h3>The Half-Blood Prince</h3>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur,
          dolorem.
        </p>
        <div class="price">$14.00</div>
        <div class="prevbutton">
          <button onclick="AddedButton('p-1')" class="buttons addtocartbutton">
            Add to Cart
          </button>
        </div>
      </div>
      <div class="preview" data-target="p-2">
        <i class="fas fa-times"></i>
        <img src="images/asong_book.png" alt="asong_book cover" />
        <h3>A Song of Ice and Fire</h3>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star-half-alt"></i>
          <span>( 250 )</span>
        </div>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur,
          dolorem.
        </p>
        <div class="price">$8.00</div>
        <div class="prevbutton">
          <button onclick="AddedButton('p-2')" class="buttons addtocartbutton">
            Add to Cart
          </button>
        </div>
      </div>
      <div class="preview" data-target="p-3">
        <i class="fas fa-times"></i>
        <img src="images/giftofbattle_book.png" alt="giftofbattle_book cover" />
        <h3>The Gift of Battle</h3>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star-half-alt"></i>
          <span>( 250 )</span>
        </div>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur,
          dolorem.
        </p>
        <div class="price">$12.00</div>
        <div class="prevbutton">
          <button onclick="AddedButton('p-3')" class="buttons addtocartbutton">
            Add to Cart
          </button>
        </div>
      </div>
      <div class="preview" data-target="p-4">
        <i class="fas fa-times"></i>
        <img
          src="images/poseidonawake_book.png"
          alt="poseidonswake_book cover"
        />
        <h3>Poseidon's Wake</h3>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star-half-alt"></i>
          <span>( 250 )</span>
        </div>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur,
          dolorem.
        </p>
        <div class="price">$8.00</div>
        <div class="prevbutton">
          <button onclick="AddedButton('p-4')" class="buttons addtocartbutton">
            Add to Cart
          </button>
        </div>
      </div>
      <div class="preview" data-target="p-5">
        <i class="fas fa-times"></i>
        <img
          src="images/deathlyhallows_book.png"
          alt="deathlyhallows_book cover"
        />
        <h3>Deathly Hallows</h3>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star-half-alt"></i>
          <span>( 250 )</span>
        </div>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur,
          dolorem.
        </p>
        <div class="price">$16.00</div>
        <div class="prevbutton">
          <button onclick="AddedButton('p-5')" class="buttons addtocartbutton">
            Add to Cart
          </button>
        </div>
      </div>
      <div class="preview" data-target="p-6">
        <i class="fas fa-times"></i>
        <img src="images/gobletoffire_book.png" alt="gobletoffire_book cover" />
        <h3>The Goblets of Fire</h3>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star-half-alt"></i>
          <span>( 250 )</span>
        </div>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur,
          dolorem.
        </p>
        <div class="price">$11.00</div>
        <div class="prevbutton">
          <button onclick="AddedButton('p-6')" class="buttons addtocartbutton">
            Add to Cart
          </button>
        </div>
      </div>
      <div class="preview" data-target="p-7">
        <i class="fas fa-times"></i>
        <img
          src="images/stormofswords_book.png"
          alt="stormofswords_book cover"
        />
        <h3>A Storm Swords</h3>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star-half-alt"></i>
          <span>( 250 )</span>
        </div>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur,
          dolorem.
        </p>
        <div class="price">$12.00</div>
        <div class="prevbutton">
          <button onclick="AddedButton('p-7')" class="buttons addtocartbutton">
            Add to Cart
          </button>
        </div>
      </div>
      <div class="preview" data-target="p-8">
        <i class="fas fa-times"></i>
        <img
          src="images/dancewdragons_book.png"
          alt="dancewdragons_book cover"
        />
        <h3>Dance with Dragons</h3>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star-half-alt"></i>
          <span>( 250 )</span>
        </div>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur,
          dolorem.
        </p>
        <div class="price">$11.00</div>
        <div class="prevbutton">
          <button onclick="AddedButton('p-8')" class="buttons addtocartbutton">
            Add to Cart
          </button>
        </div>
      </div>
      <div class="preview" data-target="p-9">
        <i class="fas fa-times"></i>
        <img
          src="images/orderofphoenix_book.png"
          alt="orderofphoenix_book cover"
        />
        <h3>Order of the Phoenix</h3>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star-half-alt"></i>
          <span>( 250 )</span>
        </div>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur,
          dolorem.
        </p>
        <div class="price">$13.00</div>
        <div class="prevbutton">
          <button onclick="AddedButton('p-9')" class="buttons addtocartbutton">
            Add to Cart
          </button>
        </div>
      </div>
      <div class="preview" data-target="p-10">
        <i class="fas fa-times"></i>
        <img src="images/littlered.jpg" alt="littleredridinghood_cover" />
        <h3>Little Red Riding Hood</h3>
        <div class="stars">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star-half-alt"></i>
          <span>( 250 )</span>
        </div>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur,
          dolorem.
        </p>
        <div class="price">$12.00</div>
        <div class="prevbutton">
          <button onclick="AddedButton('p-10')" class="buttons addtocartbutton">
            Add to Cart
          </button>
        </div>
      </div>
    </div>
    <script src="js/script1.js"></script>
  </body>
</html>
