<div class="nav-trigger col-12 shadow d-flex p-0 bg-white">
    <div class="col-2 icon-sidebar d-flex p-1 align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-bar-chart">
            <line x1="12" y1="20" x2="12" y2="10" />
            <line x1="18" y1="20" x2="18" y2="4" />
            <line x1="6" y1="20" x2="6" y2="16" />
        </svg>
    </div>
    <div class="col-5">
        <span class="fw-bold name-restaurant">Restaurant</span><br>
        <span class="table-number">Table 5</span>
    </div>
    <div class="col-5 d-flex justify-content-end align-items-center">
        <div class="col-3">
            <i class="fas fa-bell bell-icon"></i>
        </div>
        <div class="col-3">
            <i class="fas fa-search search-icon"></i>
        </div>
    </div>
</div>

<style>


    .nav-trigger {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    .icon-sidebar svg {
        width: 20px;
        height: 20px;
        fill: #888;
    }

    .name-restaurant {
        font-weight: bold;
        font-size: 16px;
        color: #333;
    }

    .table-number {
        font-size: 14px;
        color: #777;
    }

    .bell-icon,
    .search-icon {
        font-size: 18px;
        color: #888;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .bell-icon:hover,
    .search-icon:hover {
        color: #333;
    }
</style>
