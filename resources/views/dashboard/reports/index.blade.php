@extends('layouts.base')

@section('content')
<style>
    /* Page Styling */
    .container {
        padding-top: 30px;
    }

    /* Section Heading */
    .section-heading {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .section-description {
        color: #6c757d;
        margin-bottom: 30px;
        width: 80%;
    }

    /* Flexbox Layout for equal height columns */
    .reports-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .report-card-wrapper {
        flex: 0 0 48%; /* 2 cards per row, with some spacing */
        margin-bottom: 20px;
    }

    .report-card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-bottom: 30px;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .report-title {
        font-size: 18px;
        font-weight: bold;
        color: #5541D7; /* Purple color */
        margin-bottom: 20px;
        border-bottom: 2px solid #5541D7;
        padding-bottom: 10px;
    }

    .report-list {
        list-style: none;
        padding: 0;
        margin-bottom: 15px;
        flex-grow: 1;
    }

    .report-list li {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        color: #555;
        font-size: 14px;
    }

    .report-list li::before {
        content: "■";
        color: #5541D7;
        margin-right: 10px;
        font-size: 14px;
    }

    .report-list li span {
        font-weight: bold;
    }

    /* Table styling */
    .report-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        flex-grow: 1;
    }

    .report-table th,
    .report-table td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .report-table th {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    .report-table td {
        background-color: #fdfdfd;
    }

    .report-table .highlight {
        font-weight: bold;
        color: #5541D7;
    }

    /* Pagination Styling */
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination a {
        margin: 0 5px;
        padding: 8px 12px;
        border-radius: 4px;
        text-decoration: none;
        color: #5541D7;
    }

    .pagination .active {
        background-color: #5541D7;
        color: #fff;
    }

    /* Responsive Styling */
    @media (max-width: 768px) {
        .report-card {
            padding: 15px;
        }

        .report-title {
            font-size: 16px;
        }

        .report-list li {
            font-size: 12px;
        }

        .report-card-wrapper {
            flex: 0 0 100%; /* Full width on mobile */
        }
    }
</style>

<div class="container">
    <!-- Section Header -->
    <div class="text-left mb-4">
        <div class="section-heading">Reports Overview</div>
        <div class="section-description">
            This section provides an overview of key reports related to members, contributions, assets, and groups in your system. Below are detailed reports with additional statistics and tables for better clarity.
        </div>
    </div>

    <!-- Reports Grid -->
    <div class="reports-grid">
        <!-- Members Report -->
        <div class="report-card-wrapper">
            <div class="report-card">
                <div class="report-title">Members</div>
                <ul class="report-list">
                    <li><span>Total Members:</span> {{ $totalmembers }}</li>
                    <li><span>Active Members:</span> {{ $activeMembers }}</li>
                    <li><span>Inactive Members:</span> {{ $inactiveMembers }}</li>
                    <li><span>New Members This Month:</span> {{ $newMembersThisMonth }}</li>
                    <li><span>Last Updated:</span> {{ $membersUpdatedDate->format('M d, Y') }}</li>
                </ul>
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>Member ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Joined Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentMembers as $member)
                            <tr>
                                <td>{{ $member->id }}</td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->member_status }}</td>
                                <td>{{ $member->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination -->
                <div class="pagination">
                    {{ $members->links() }}
                </div>
            </div>
        </div>

     <!-- Contributions Report -->
<div class="report-card-wrapper">
    <div class="report-card">
        <div class="report-title">Contributions</div>
        <ul class="report-list">
            <li><span>Total Contributions:</span> ${{ number_format($contributions->sum('amount'), 2) }}</li>
            <li><span>Average Contribution:</span> ${{ number_format($averageContribution, 2) }}</li>
            <li><span>Highest Contribution:</span> ${{ number_format($highestContribution, 2) }}</li>
            <li><span>Last Contribution:</span> ${{ number_format($lastContribution, 2) }}</li>
            <li><span>Last Updated:</span> {{ $contributionsUpdatedDate->format('M d, Y') }}</li>
        </ul>
        <table class="report-table">
            <thead>
                <tr>
                    <th>Contribution ID</th>
                    <th>Member ID</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentContributions as $contribution)
                    <tr>
                        <td>{{ $contribution->id }}</td>
                        <td>{{ $contribution->member_id }}</td>
                        <td>${{ number_format($contribution->amount, 2) }}</td>
                        <td>{{ $contribution->created_at->format('M d, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination -->
        <div class="pagination">
            {{ $contributions->links() }}
        </div>
    </div>
</div>

        <!-- Assets Report -->
        <div class="report-card-wrapper">
            <div class="report-card">
                <div class="report-title">Assets</div>
                <ul class="report-list">
                    <li><span>Total Assets:</span> {{ $totalassets }}</li>
                    <li><span>Current Asset Value:</span> ${{ number_format($currentAssetValue, 2) }}</li>
                    <li><span>Assets Added This Month:</span> {{ $assetsAddedThisMonth }}</li>
                    <li><span>Last Updated:</span> {{ $assetsUpdatedDate->format('M d, Y') }}</li>
                </ul>
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>Asset ID</th>
                            <th>Asset Name</th>
                            <th>Value</th>
                            <th>Added Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentAssets as $asset)
                            <tr>
                                <td>{{ $asset->id }}</td>
                                <td>{{ $asset->name }}</td>
                                <td>${{ number_format($asset->price, 2) }}</td>
                                <td>{{ $asset->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination -->
                <div class="pagination">
                    {{ $assets->links() }}
                </div>
            </div>
        </div>

        <!-- Groups Report -->
        <div class="report-card-wrapper">
            <div class="report-card">
                <div class="report-title">Groups</div>
                <ul class="report-list">
                    <li><span>Total Groups:</span> {{ $totalgroups }}</li>
                    <li><span>New Groups This Month:</span> {{ $newGroupsThisMonth }}</li>
                    <li><span>Last Updated:</span> {{ $groupsUpdatedDate->format('M d, Y') }}</li>
                </ul>
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>Group ID</th>
                            <th>Group Name</th>
                            
                            <th>Created Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentGroups as $group)
                            <tr>
                                <td>{{ $group->id }}</td>
                                <td>{{ $group->name }}</td>
                           
                                <td>{{ $group->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination -->
                <div class="pagination">
                    {{ $groups->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
