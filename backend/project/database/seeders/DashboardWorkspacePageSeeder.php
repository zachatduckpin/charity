<?php

namespace Database\Seeders;

use App\Models\DashboardWorkspacePage;
use App\Support\Dashboard\GnCentralCatalog;
use Illuminate\Database\Seeder;

class DashboardWorkspacePageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'member-operations',
                'title' => 'Member Operations',
                'eyebrow' => 'GN Central · Member lifecycle',
                'description' => 'One working area for reporting, renewal, meetings, collaborative projects, and annual action planning.',
                'view' => 'operations',
                'data' => [
                    'metrics' => [
                        ['label' => 'Current tier', 'value' => 'Associate', 'detail' => 'In good standing'],
                        ['label' => 'Next report', 'value' => '31 Dec', 'detail' => '164 days remaining'],
                        ['label' => 'Renewal window', 'value' => 'Open', 'detail' => 'Online year-round'],
                        ['label' => 'Action plan', 'value' => '62%', 'detail' => '4 of 7 objectives active'],
                    ],
                    'tabs' => [
                        [
                            'id' => 'reporting',
                            'label' => 'Reporting & Renewal',
                            'badge' => 'In good standing',
                            'title' => 'Reporting & Renewal Centre',
                            'description' => 'Complete the two six-month activity reports, maintain evidence, renew membership, and request an eligible level change from one record.',
                            'panels' => [
                                [
                                    'type' => 'steps-panel',
                                    'title' => 'Current cycle',
                                    'footer_label' => 'Overall annual compliance',
                                    'footer_progress' => 58,
                                    'items' => [
                                        ['step' => '✓', 'title' => 'January-June activity report', 'detail' => 'Submitted 8 July 2026 · evidence verified', 'status' => 'Complete', 'tone' => 'success'],
                                        ['step' => '2', 'title' => 'July-December activity report', 'detail' => 'Draft opens 1 December · due 31 December 2026', 'status' => 'Upcoming', 'tone' => 'warning'],
                                        ['step' => '3', 'title' => 'Annual renewal', 'detail' => 'Profile, declarations, and payment confirmation', 'status' => 'Available', 'tone' => 'info'],
                                    ],
                                ],
                                [
                                    'type' => 'summary-panel',
                                    'title' => 'Membership status',
                                    'lines' => [
                                        ['label' => 'Tier', 'value' => 'Associate Member'],
                                        ['label' => 'Member since', 'value' => '1 August 2025'],
                                        ['label' => 'Renewal date', 'value' => '1 August 2026'],
                                        ['label' => 'Level-change eligibility', 'value' => 'Eligible at renewal after one full year.'],
                                    ],
                                    'actions' => [
                                        ['label' => 'Continue to payment', 'tone' => 'gold', 'message' => 'Payment gateway hand-off is ready for connection to the approved IDA payment provider.'],
                                        ['label' => 'Request tier change', 'tone' => 'secondary', 'message' => 'A tier-change request may be submitted with this renewal.'],
                                    ],
                                ],
                            ],
                            'form' => [
                                'title' => 'Prepare a six-month report',
                                'description' => 'The prototype saves a review draft on this device. The production version will upload the report and media to the member\'s controlled profile.',
                            ],
                            'notice' => 'Formal submission, secure evidence storage, and payment processing require the GN Central database, signed-in member identity, and approved payment provider. No financial details are collected in this prototype.',
                        ],
                        [
                            'id' => 'meetings',
                            'label' => 'Meetings & Events',
                            'badge' => 'Future dates on hold',
                            'title' => 'Meetings & Events Hub',
                            'description' => 'A permission-aware calendar for confirmed meetings, attendance, agendas, recordings, and approved archives.',
                            'notice' => 'IDA Home Office calendar notice - Steve O\'Brien is reviewing the remaining meeting dates for 2026. GN Central will not publish provisional future dates until the finalized calendar has been posted.',
                            'records' => [
                                ['date' => 'SEP 2026', 'title' => 'Global Network Community Forum', 'detail' => 'Moving from July to September · exact date and time pending confirmation', 'status' => 'Date pending', 'tone' => 'warning'],
                                ['date' => '2026 CAL', 'title' => 'Current committee calendar', 'detail' => 'January 2026 edition retained as a reference while revisions are finalized', 'status' => 'Committee access', 'tone' => 'info'],
                                ['date' => 'NEXT DATES', 'title' => 'Balance-of-year meetings', 'detail' => 'Under review by the GN Committee Chair · no dates published', 'status' => 'Awaiting IDA', 'tone' => 'info'],
                            ],
                            'archive' => [
                                ['step' => '✓', 'title' => '15 July 2026 Executive Committee', 'detail' => '7:30 AM Eastern · agenda on record · summary pending', 'status' => 'Committee', 'tone' => 'warning'],
                                ['step' => '✓', 'title' => '29 April 2026 Executive Committee', 'detail' => 'Agenda · approved meeting summary', 'status' => 'Committee', 'tone' => 'warning'],
                                ['step' => '✓', 'title' => 'February 2026 Sip & Chat', 'detail' => 'Summary · shared resources', 'status' => 'Member', 'tone' => 'success'],
                            ],
                        ],
                        [
                            'id' => 'projects',
                            'label' => 'Collaborative Projects',
                            'badge' => 'Policy alignment required',
                            'title' => 'Collaborative Projects Workspace',
                            'description' => 'Develop cross-network initiatives, invite participating organizations, and move proposals through transparent review and monitoring.',
                            'cards' => [
                                ['title' => '1 · Develop', 'body' => 'Define the shared need, intended beneficiaries, participating members, and measurable result.'],
                                ['title' => '2 · Review', 'body' => 'Authorized reviewers assess strategic fit, feasibility, safeguards, budget, and global value.'],
                                ['title' => '3 · Deliver', 'body' => 'Approved projects record agreements, milestones, evidence, spending, and final outcomes.'],
                            ],
                            'notice' => 'Historical source forms use older Partner-only wording. Publication and formal submission should be enabled only after the forms are reconciled with the approved Handbook.',
                        ],
                        [
                            'id' => 'planning',
                            'label' => 'Action Planning',
                            'badge' => '2026 plan active',
                            'title' => 'Member Action Planning',
                            'description' => 'Translate annual priorities into owned, measurable objectives that can feed the programme-health dashboard.',
                            'progress' => 62,
                            'steps' => [
                                ['step' => '✓', 'title' => 'Teacher awareness programme', 'detail' => 'Target exceeded · 420 teachers reached', 'status' => 'Complete', 'tone' => 'success'],
                                ['step' => '2', 'title' => 'Family support expansion', 'detail' => '72% · evidence updated 15 July', 'status' => 'On track', 'tone' => 'info'],
                                ['step' => '3', 'title' => 'Regional collaboration', 'detail' => '35% · partner confirmation pending', 'status' => 'Watch', 'tone' => 'warning'],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        foreach ([
            'member-leadership',
            'membership-options',
            'handbook',
            'video-library',
            'resource-centre',
            'accreditation',
            'accreditation-application',
            'accreditation-workspace',
            'accreditation-reviewer-training',
            'priority-queue',
            'engagement',
            'authority-levels',
        ] as $slug) {
            $config = GnCentralCatalog::workspace($slug);

            $pages[] = [
                'slug' => $slug,
                'title' => $config['title'],
                'eyebrow' => $config['eyebrow'] ?? null,
                'description' => $config['description'] ?? null,
                'view' => 'workspace',
                'data' => [
                    'metrics' => $config['metrics'] ?? [],
                    'sections' => $config['sections'] ?? [],
                ],
            ];
        }

        foreach ($pages as $page) {
            DashboardWorkspacePage::query()->updateOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }
}
