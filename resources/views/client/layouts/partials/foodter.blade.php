
<footer class="fixed-bottom bg-white">
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <i class="fas fa-table icon_footer"></i>
                <div class="footer-text">Table</div>
            </div>
            <div class="col"  data-href="{{ route('client.getListCart') }}">
                <i class="fas fa-utensils icon_footer"></i>
                <div class="footer-text">Cart</div>
            </div>
            <div class="col">
                <i class="fas fa-home icon_footer active_fd"></i>
                <div class="footer-text active">Home</div>
            </div>
            <div class="col">
                <i class="fas fa-history icon_footer"></i>
                <div class="footer-text">History</div>
            </div>
            <div class="col">
                <i class="fas fa-user icon_footer"></i>
                <div class="footer-text">Profile</div>
            </div>
        </div>
    </div>
</footer>

<style>
footer {
  box-shadow: 0px -4px 8px rgba(0, 0, 0, 0.2);
}
.footer-text {
    font-size: 12px;
    margin-top: 3px;
}

.icon_footer {
    font-size: 20px;
    margin-bottom: 3px;
    color: #888; /* Original icon color */
}

.active_fd {
    color: #3455DB; /* Updated color for the active item */
    font-weight: bold;
    transform: scale(1.1);
}

.active_fd .icon_footer {
    color: #3455DB; /* Updated color for the active icon */
}
</style>
