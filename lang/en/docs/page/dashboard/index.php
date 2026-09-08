<?php

return [
    /*
    |--------------------------------------------------------------------------
    | eCommerce Dashboard Language Lines (English)
    |--------------------------------------------------------------------------
    */
    'title' => 'eCommerce Dashboard',
    'subtitle' => 'Monitor sales performance, inbound orders, and business growth in real-time.',
    'breadcrumb' => [
        'home' => 'Home',
        'pages' => 'Pages',
        'dashboard' => 'Dashboard',
    ],
    'actions' => [
        'export' => 'Export Report',
        'add_product' => 'Add Product',
        'filter_period' => 'Select Period',
        'today' => 'Today',
        'last_7_days' => 'Last 7 Days',
        'last_30_days' => 'This Month',
        'this_year' => 'This Year',
        'view_all' => 'View All',
        'details' => 'View Details',
        'invoice' => 'Download Invoice',
        'contact' => 'Contact Customer',
        'restock' => 'Reorder Stock',
    ],
    'toolbar' => [
        'title' => 'Interactive Dashboard Grid',
        'desc' => 'Drag card headers to reorder positions or use card corner handles to resize widths.',
    ],
    'metrics' => [
        'revenue' => [
            'title' => 'Total Revenue',
            'desc' => 'Gross sales accumulation',
            'badge' => '+18.4%',
            'comparison' => 'Increased Rp 44.2M compared to last month',
        ],
        'orders' => [
            'title' => 'Total Orders',
            'desc' => 'Successful checkout volume',
            'badge' => '+11.2%',
            'comparison' => '98.4% of orders delivered on schedule',
        ],
        'customers' => [
            'title' => 'New Customers',
            'desc' => 'Newly registered users',
            'badge' => '+22.8%',
            'comparison' => '142 recurring (repeat) buyers',
        ],
        'avg_order' => [
            'title' => 'Average Order Value',
            'desc' => 'Average Order Value (AOV)',
            'badge' => '+5.3%',
            'comparison' => 'Quarterly target Rp 150,000 achieved 103%',
        ],
    ],
    'charts' => [
        'sales_trend' => [
            'title' => 'Sales & Revenue Trend',
            'desc' => 'Monthly gross sales vs net profit comparison',
            'revenue_legend' => 'Revenue',
            'profit_legend' => 'Net Profit',
            'total_sales' => 'Total Sales',
            'net_profit' => 'Net Profit',
            'daily_avg' => 'Daily Average',
            'tabs' => [
                'weekly' => 'Weekly',
                'monthly' => 'Monthly',
                'yearly' => 'Yearly',
            ],
        ],
        'channels' => [
            'title' => 'Acquisition & Conversion',
            'desc' => 'Traffic sources breakdown and transaction volume',
            'conversion_label' => 'Average Conversion Rate',
            'direct' => 'Direct Traffic',
            'organic' => 'Organic Search',
            'social' => 'Social Media',
            'referral' => 'Affiliate & Referral',
        ],
    ],
    'products' => [
        'top_title' => 'Top Selling Products',
        'top_desc' => 'Ranked by unit sales volume this month',
        'badge' => 'Top 5',
        'stock_remaining' => ':count units left',
        'sales_count' => ':count sold',
        'view_all_products' => 'Manage Product Catalog',
    ],
    'orders' => [
        'title' => 'Recent Inbound Orders',
        'desc' => 'Latest checkout transactions from registered customers',
        'columns' => [
            'order_id' => 'Order ID',
            'customer' => 'Customer',
            'items' => 'Items Ordered',
            'total' => 'Total Amount',
            'status' => 'Status',
            'action' => 'Action',
        ],
        'status' => [
            'completed' => 'Completed',
            'processing' => 'Processing',
            'pending' => 'Pending Payment',
            'cancelled' => 'Cancelled',
        ],
    ],
    'alerts' => [
        'inventory_title' => 'Low Stock Alerts',
        'inventory_desc' => 'Items requiring immediate supplier replenishment',
        'critical' => 'Critical',
        'warning' => 'Warning',
        'safe' => 'Healthy',
    ],
    'activity' => [
        'title' => 'Store Activity Log',
        'desc' => 'Automated event stream from system and buyers',
        'time_ago' => [
            'just_now' => 'Just now',
            'mins_ago' => ':count min ago',
            'hours_ago' => ':count hrs ago',
        ],
    ],
];
