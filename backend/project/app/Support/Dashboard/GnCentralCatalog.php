<?php

namespace App\Support\Dashboard;

class GnCentralCatalog
{
    public static function navigation(): array
    {
        return [
            [
                'type' => 'item',
                'label' => 'Home',
                'icon' => '⌂',
                'route' => 'dashboard.index',
                'permission' => 'dashboard.view',
                'patterns' => ['dashboard.index'],
            ],
            [
                'type' => 'item',
                'label' => 'Applications',
                'icon' => '▤',
                'route' => 'dashboard.membership-applications.index',
                'permission' => 'membership-applications.view',
                'patterns' => ['dashboard.membership-applications.*'],
            ],
            [
                'type' => 'item',
                'label' => 'Campaigns',
                'icon' => '◈',
                'route' => 'dashboard.campaigns.index',
                'permission' => 'campaigns.view',
                'patterns' => ['dashboard.campaigns.*'],
            ],
            [
                'type' => 'item',
                'label' => 'Donations',
                'icon' => '◌',
                'route' => 'dashboard.donations.index',
                'permission' => 'donations.view',
                'patterns' => ['dashboard.donations.*'],
            ],
            [
                'type' => 'item',
                'label' => 'Events',
                'icon' => '◇',
                'route' => 'dashboard.events.index',
                'permission' => 'events.view',
                'patterns' => ['dashboard.events.*'],
            ],
            [
                'type' => 'group',
                'label' => 'Global Network Members',
                'icon' => '◎',
                'patterns' => ['dashboard.members.*', 'dashboard.member-leadership.*', 'dashboard.member-profile.*'],
                'children' => [
                    ['label' => 'Members Directory', 'route' => 'dashboard.members.index', 'permission' => 'members.view', 'patterns' => ['dashboard.members.*']],
                    ['label' => 'Member Leadership', 'route' => 'dashboard.member-leadership.index', 'permission' => 'member-leadership.view', 'patterns' => ['dashboard.member-leadership.*']],
                    ['label' => 'Member Profile', 'route' => 'dashboard.member-profile.show', 'permission' => 'member-profile.view', 'patterns' => ['dashboard.member-profile.*']],
                ],
            ],
            [
                'type' => 'item',
                'label' => 'Member Operations',
                'icon' => '◫',
                'route' => 'dashboard.member-operations.index',
                'permission' => 'member-operations.view',
                'patterns' => ['dashboard.member-operations.*'],
            ],
            [
                'type' => 'group',
                'label' => 'Resources',
                'icon' => '▥',
                'patterns' => ['dashboard.membership-options.*', 'dashboard.handbook.*', 'dashboard.video-library.*', 'dashboard.resource-centre.*'],
                'children' => [
                    ['label' => 'Membership Options', 'route' => 'dashboard.membership-options.index', 'permission' => 'membership-options.view', 'patterns' => ['dashboard.membership-options.*']],
                    ['label' => 'GN Handbook', 'route' => 'dashboard.handbook.index', 'permission' => 'handbook.view', 'patterns' => ['dashboard.handbook.*']],
                    ['label' => 'Video Library', 'route' => 'dashboard.video-library.index', 'permission' => 'video-library.view', 'patterns' => ['dashboard.video-library.*']],
                    ['label' => 'Communications', 'route' => 'dashboard.resource-centre.index', 'permission' => 'resource-centre.view', 'patterns' => ['dashboard.resource-centre.*']],
                ],
            ],
            [
                'type' => 'group',
                'label' => 'Institutional Accreditation',
                'icon' => '✪',
                'patterns' => ['dashboard.accreditation.*', 'dashboard.accreditation-application.*', 'dashboard.accreditation-workspace.*', 'dashboard.accreditation-reviewer-training.*'],
                'children' => [
                    ['label' => 'Overview', 'route' => 'dashboard.accreditation.index', 'permission' => 'accreditation.view', 'patterns' => ['dashboard.accreditation.index']],
                    ['label' => 'Apply Online', 'route' => 'dashboard.accreditation-application.index', 'permission' => 'accreditation-application.view', 'patterns' => ['dashboard.accreditation-application.*']],
                    ['label' => 'Process Workspace', 'route' => 'dashboard.accreditation-workspace.index', 'permission' => 'accreditation-workspace.view', 'patterns' => ['dashboard.accreditation-workspace.*']],
                    ['label' => 'Reviewer Training', 'route' => 'dashboard.accreditation-reviewer-training.index', 'permission' => 'accreditation-reviewer-training.view', 'patterns' => ['dashboard.accreditation-reviewer-training.*']],
                ],
            ],
            [
                'type' => 'item',
                'label' => 'Priority Queue',
                'icon' => '✓',
                'route' => 'dashboard.priority-queue.index',
                'permission' => 'priority-queue.view',
                'patterns' => ['dashboard.priority-queue.*'],
            ],
            [
                'type' => 'item',
                'label' => 'Engagement Dashboard',
                'icon' => '▥',
                'route' => 'dashboard.engagement.index',
                'permission' => 'engagement.view',
                'patterns' => ['dashboard.engagement.*'],
            ],
            [
                'type' => 'item',
                'label' => 'Authority & Profiles',
                'icon' => '⚙',
                'route' => 'dashboard.authority-levels.index',
                'permission' => 'authority-levels.view',
                'patterns' => ['dashboard.authority-levels.*'],
            ],
        ];
    }

    public static function flatNavigation(): array
    {
        $items = [];

        foreach (self::navigation() as $item) {
            if (($item['type'] ?? 'item') === 'item') {
                $items[] = $item;
                continue;
            }

            foreach ($item['children'] ?? [] as $child) {
                $label = $child['label'];

                if (($item['label'] ?? null) === 'Institutional Accreditation' && in_array($label, ['Overview', 'Apply Online', 'Process Workspace', 'Reviewer Training'], true)) {
                    $label = 'Accreditation: ' . $label;
                }

                $items[] = [
                    'type' => 'item',
                    'label' => $label,
                    'icon' => $child['icon'] ?? $item['icon'],
                    'route' => $child['route'],
                    'permission' => $child['permission'] ?? null,
                    'patterns' => $child['patterns'] ?? [],
                ];
            }
        }

        return $items;
    }

    public static function executiveCommittee(): array
    {
        return [
            ['name' => 'Mr. Steve O\'Brien', 'role' => 'Chair, IDA Global Network Executive Committee', 'organization' => 'CEO, Dyslexia Foundation', 'member_slug' => 'dyslexia-foundation', 'level' => 'Contributor'],
            ['name' => 'Dr. Gad Elbeheri', 'role' => 'Member, IDA Global Network Executive Committee', 'organization' => 'IDA Advisor, Special Projects', 'member_slug' => null, 'level' => 'Leadership'],
            ['name' => 'Dr. Eric Tridas', 'role' => 'Member, IDA Global Network Executive Committee', 'organization' => 'Committee leadership', 'member_slug' => null, 'level' => 'Leadership'],
            ['name' => 'Professor Charles Haynes', 'role' => 'Member, IDA Global Network Executive Committee', 'organization' => 'Committee leadership', 'member_slug' => null, 'level' => 'Leadership'],
            ['name' => 'Dr. Elsa Cardenas-Hagan', 'role' => 'Member, IDA Global Network Executive Committee', 'organization' => 'Committee leadership', 'member_slug' => null, 'level' => 'Leadership'],
            ['name' => 'Phyllis Munyi', 'role' => 'Member, IDA Global Network Executive Committee', 'organization' => 'CEO, Kenya Dyslexia Association', 'member_slug' => 'dyslexia-organization-kenya', 'level' => 'Associate'],
            ['name' => 'Dr. Geetha Shantha Ram', 'role' => 'Member, IDA Global Network Executive Committee', 'organization' => 'Dyslexia Association of Singapore', 'member_slug' => 'dyslexia-association-of-singapore', 'level' => 'Partner'],
            ['name' => 'Mr. Lee Siang', 'role' => 'Member, IDA Global Network Executive Committee', 'organization' => 'CEO, Dyslexia Association of Singapore', 'member_slug' => 'dyslexia-association-of-singapore', 'level' => 'Partner'],
        ];
    }

    public static function atLargeFriends(): array
    {
        return [
            ['name' => 'Tomohiro Inoue', 'organization' => 'The Chinese University of Hong Kong, Hong Kong', 'label' => 'At-Large Friend'],
            ['name' => 'Professor Juan Luque', 'organization' => 'University of Malaga, Spain', 'label' => 'At-Large Friend'],
            ['name' => 'Jeranji Kamfoso', 'organization' => 'Dyslexia Malawi / Able Foundation, Malawi', 'label' => 'At-Large Friend · Prospective Applicant'],
            ['name' => 'Dr. Marlon-Ralph Nyakabau', 'organization' => 'Dyslexia in Africa Trust, Zimbabwe', 'label' => 'At-Large Friend'],
            ['name' => 'Mrs. Merlaine Yeo', 'organization' => 'Unlock Learning, South Africa', 'label' => 'At-Large Friend'],
            ['name' => 'Dr. Ahmed Al Shiha', 'organization' => 'Kuwait Dyslexia Association', 'label' => 'At-Large Friend'],
            ['name' => 'Mrs. Blessing Ingyape', 'organization' => 'Dyslexia Project Africa, Nigeria', 'label' => 'At-Large Friend'],
        ];
    }

    public static function quickActions(): array
    {
        return [
            ['title' => 'Review Applications', 'description' => 'Open partner requests, assign reviewers, and track approval decisions.', 'route' => 'dashboard.membership-applications.index', 'permission' => 'membership-applications.view'],
            ['title' => 'Open Accreditation Workspace', 'description' => 'Track an accreditation case, review evidence, and record standards-based findings.', 'route' => 'dashboard.accreditation-workspace.index', 'permission' => 'accreditation-workspace.view'],
            ['title' => 'Open Member Directory', 'description' => 'Move from the home dashboard into the current GN member roster.', 'route' => 'dashboard.members.index', 'permission' => 'members.view'],
            ['title' => 'Check Authority Levels', 'description' => 'Review who can view, manage, review, decide, and administer each GN workspace.', 'route' => 'dashboard.authority-levels.index', 'permission' => 'authority-levels.view'],
        ];
    }

    public static function workspace(string $page): array
    {
        return match ($page) {
            'member-leadership' => [
                'title' => 'Member Leadership',
                'eyebrow' => 'Global Network members',
                'description' => 'Leadership-facing profiles across current member organizations, aligned to the GN Central leadership view.',
                'metrics' => [
                    ['label' => 'Executive committee', 'value' => 8, 'detail' => 'Current committee and chair records'],
                    ['label' => 'Member leaders', 'value' => 17, 'detail' => 'Organizations represented in the directory'],
                    ['label' => 'Tier coverage', 'value' => '3', 'detail' => 'Associate, Contributor, and Partner'],
                ],
                'sections' => [
                    [
                        'type' => 'cards',
                        'title' => 'Leadership Highlights',
                        'description' => 'Representative leaders surfaced from the GN Central reference set.',
                        'columns' => 2,
                        'items' => [
                            ['title' => 'Mr. Steve O\'Brien', 'body' => 'CEO, Dyslexia Foundation · Executive Committee Chair', 'badge' => 'Contributor', 'route' => 'dashboard.member-profile.show', 'route_params' => ['member' => 'dyslexia-foundation']],
                            ['title' => 'Phyllis Munyi', 'body' => 'CEO, Kenya Dyslexia Association · Executive Committee member', 'badge' => 'Associate', 'route' => 'dashboard.member-profile.show', 'route_params' => ['member' => 'dyslexia-organization-kenya']],
                            ['title' => 'Kate Currawalla', 'body' => 'Founder President and CEO, Maharashtra Dyslexia Association', 'badge' => 'Contributor', 'route' => 'dashboard.member-profile.show', 'route_params' => ['member' => 'maharashtra-dyslexia-association']],
                            ['title' => 'Lee Siang', 'body' => 'CEO, Dyslexia Association of Singapore · Executive Committee member', 'badge' => 'Partner', 'route' => 'dashboard.member-profile.show', 'route_params' => ['member' => 'dyslexia-association-of-singapore']],
                        ],
                    ],
                    [
                        'type' => 'notice',
                        'tone' => 'info',
                        'title' => 'Dual-role note',
                        'body' => 'A leader who also serves on the GN Executive Committee may appear in both leadership and committee contexts. Organizational role and GN governance role should remain distinct in the backend data model.',
                    ],
                ],
            ],
            'member-operations' => [
                'title' => 'Member Operations',
                'eyebrow' => 'GN Central · Member lifecycle',
                'description' => 'One working area for reporting, renewal, meetings, collaborative projects, and annual action planning.',
                'metrics' => [
                    ['label' => 'Operational modules', 'value' => 4, 'detail' => 'Meetings, renewals, projects, action planning'],
                    ['label' => 'Calendar items', 'value' => 3, 'detail' => 'Current committee and forum records'],
                    ['label' => 'Policy notices', 'value' => 2, 'detail' => 'Controls carried over from the GN reference'],
                ],
                'sections' => [
                    [
                        'type' => 'cards',
                        'title' => 'Meetings & Events Hub',
                        'description' => 'Permission-aware scheduling, archive, and calendar signals.',
                        'items' => [
                            ['title' => 'Global Network Community Forum', 'body' => 'Moving from July to September with date confirmation still pending.', 'badge' => 'Date pending'],
                            ['title' => 'Current committee calendar', 'body' => 'January 2026 edition retained as a reference while revisions are finalized.', 'badge' => 'Committee access'],
                            ['title' => 'Balance-of-year meetings', 'body' => 'Future dates are under review by the GN Committee Chair.', 'badge' => 'Awaiting IDA'],
                        ],
                    ],
                    [
                        'type' => 'steps',
                        'title' => 'Collaborative Projects Workspace',
                        'description' => 'The GN Central review flow for cross-network projects.',
                        'items' => [
                            ['title' => '1 · Develop', 'body' => 'Define the shared need, participating members, and measurable result.'],
                            ['title' => '2 · Review', 'body' => 'Authorized reviewers assess strategic fit, feasibility, safeguards, budget, and global value.'],
                            ['title' => '3 · Deliver', 'body' => 'Approved projects track agreements, milestones, evidence, spending, and outcomes.'],
                        ],
                    ],
                ],
            ],
            'membership-options' => [
                'title' => 'Membership Options',
                'eyebrow' => 'Resources · Membership framework',
                'description' => 'A backend-managed summary of Associate, Contributor, and Partner pathways from the GN Central reference.',
                'metrics' => [
                    ['label' => 'Membership levels', 'value' => 3, 'detail' => 'Associate, Contributor, and Partner'],
                    ['label' => 'Key review stages', 'value' => 4, 'detail' => 'Submit, review, recommend, decide'],
                    ['label' => 'Decision bodies', 'value' => 2, 'detail' => 'GN Executive Committee and IDA Board'],
                ],
                'sections' => [
                    [
                        'type' => 'cards',
                        'title' => 'Membership Levels',
                        'description' => 'Current tier framing used across the GN Central reference.',
                        'items' => [
                            ['title' => 'Associate', 'body' => 'Entry-level Global Network membership focused on participation, visibility, and structured collaboration.', 'badge' => 'Foundation tier'],
                            ['title' => 'Contributor', 'body' => 'Expanded contribution level with greater programme engagement and leadership opportunity.', 'badge' => 'Programme tier'],
                            ['title' => 'Partner', 'body' => 'Highest tier with strong leadership participation and automatic board-facing visibility.', 'badge' => 'Leadership tier'],
                        ],
                    ],
                    [
                        'type' => 'steps',
                        'title' => 'Membership Review Flow',
                        'description' => 'The backend route map should preserve this decision path.',
                        'items' => [
                            ['title' => '1 · Apply', 'body' => 'The organization submits a controlled membership application.'],
                            ['title' => '2 · Review', 'body' => 'The GN Executive Committee reviews and recommends the request.'],
                            ['title' => '3 · Decide', 'body' => 'The IDA Board confirms the final membership outcome where required.'],
                            ['title' => '4 · Onboard', 'body' => 'The approved organization is added into GN Central workspaces and member resources.'],
                        ],
                    ],
                ],
            ],
            'handbook' => [
                'title' => 'Global Network Handbook',
                'eyebrow' => 'Resources · Governance and Member Guidance',
                'description' => 'A single home for the Global Network membership framework, governance, and digital administration notes.',
                'metrics' => [
                    ['label' => 'Current status', 'value' => 'Approval pending', 'detail' => 'Editorial work complete'],
                    ['label' => 'Proposed effective date', 'value' => '1 Aug 2026', 'detail' => 'Subject to CEO approval'],
                    ['label' => 'Core chapters', 'value' => 12, 'detail' => 'Current draft chapter structure'],
                ],
                'sections' => [
                    [
                        'type' => 'steps',
                        'title' => 'Approval Workflow',
                        'description' => 'The current handbook lifecycle reflected in GN Central.',
                        'items' => [
                            ['title' => 'Editorial completion', 'body' => 'Terminology, policy flow, and GN Central procedures consolidated.'],
                            ['title' => 'IDA CEO approval', 'body' => 'Current stage. Formal approval and publication authorization pending.'],
                            ['title' => 'Approved publication', 'body' => 'Replace draft assets with the signed, controlled edition.'],
                            ['title' => 'Effective and maintained', 'body' => 'Operate from the approved edition with controlled future amendments.'],
                        ],
                    ],
                    [
                        'type' => 'cards',
                        'title' => 'Chapter Highlights',
                        'description' => 'Key sections called out in the reference handbook.',
                        'items' => [
                            ['title' => 'Governance and Authority', 'body' => 'Executive Committee responsibilities, composition, voting, and conflicts.'],
                            ['title' => 'GN Central Administration', 'body' => 'Digital access, authority levels, controlling records, and accessibility.'],
                            ['title' => 'Handbook Administration', 'body' => 'Ownership, review, amendments, approval, and publication control.'],
                        ],
                    ],
                ],
            ],
            'video-library' => [
                'title' => 'Video & Reels Library',
                'eyebrow' => 'Resources · Media library',
                'description' => 'A curated place for promotional and educational videos aligned with the GN Central resource model.',
                'metrics' => [
                    ['label' => 'Collections', 'value' => 3, 'detail' => 'Promotional, educational, and member stories'],
                    ['label' => 'Publishing states', 'value' => 3, 'detail' => 'Draft, approved, and live'],
                    ['label' => 'Accessibility checks', 'value' => 'Required', 'detail' => 'Captions, alt context, and source records'],
                ],
                'sections' => [
                    [
                        'type' => 'cards',
                        'title' => 'Featured Collections',
                        'description' => 'Top-level collections carried into the backend workspace.',
                        'items' => [
                            ['title' => 'Promotional Library', 'body' => 'High-level videos supporting member recruitment and network awareness.'],
                            ['title' => 'Educational Reels', 'body' => 'Short-form media for awareness, advocacy, and member guidance.'],
                            ['title' => 'Member Stories', 'body' => 'Organization highlights and cross-network storytelling content.'],
                        ],
                    ],
                    [
                        'type' => 'notice',
                        'tone' => 'warning',
                        'title' => 'Publishing control',
                        'body' => 'Only approved, captioned, and authority-cleared media should be visible in the shared video library.',
                    ],
                ],
            ],
            'resource-centre' => [
                'title' => 'Communications Centre',
                'eyebrow' => 'Resources · Controlled publishing',
                'description' => 'Approved updates, governance references, and reusable communications assets for GN Central.',
                'metrics' => [
                    ['label' => 'News items', 'value' => 3, 'detail' => 'Approved communication examples'],
                    ['label' => 'Governance references', 'value' => 7, 'detail' => 'Controlled preview and committee materials'],
                    ['label' => 'Toolkit areas', 'value' => 3, 'detail' => 'Brand, campaign, and video assets'],
                ],
                'sections' => [
                    [
                        'type' => 'table',
                        'title' => 'Governance Library',
                        'description' => 'Committee references are separated from general member guidance.',
                        'columns' => ['Reference', 'Status', 'Audience', 'Control'],
                        'rows' => [
                            ['IDA Global Network Handbook', 'Awaiting CEO approval', 'Controlled preview', 'Open record'],
                            ['Open Forum members directory', 'Updated 1 August 2026', 'Authorized GN users', 'Word / PDF'],
                            ['IDA Bylaws', '2019 source edition', 'Committee', 'Verify latest edition'],
                            ['Executive Committee roles', 'Working drafts identified', 'Committee', 'Approval required'],
                        ],
                    ],
                    [
                        'type' => 'cards',
                        'title' => 'Approved Marketing Toolkit',
                        'description' => 'Reusable programme assets for consistent member recruitment and communications.',
                        'items' => [
                            ['title' => 'Brand & Logos', 'body' => 'Approved GN logo files, usage guidance, colors, and clear-space rules.'],
                            ['title' => 'Campaign Materials', 'body' => 'Recruitment messaging, social posts, membership infographics, and templates.'],
                            ['title' => 'Video & Reels', 'body' => 'Promotional and educational videos from the curated media library.', 'route' => 'dashboard.video-library.index'],
                        ],
                    ],
                ],
            ],
            'accreditation' => [
                'title' => 'Institutional Accreditation',
                'eyebrow' => 'Accreditation programme',
                'description' => 'Overview of eligibility, process structure, and controlled backend workspaces for accreditation activity.',
                'metrics' => [
                    ['label' => 'Primary workspaces', 'value' => 4, 'detail' => 'Overview, application, workspace, training'],
                    ['label' => 'Core stages', 'value' => 5, 'detail' => 'Eligibility through decision'],
                    ['label' => 'Decision pathway', 'value' => 'Controlled', 'detail' => 'Reviewer and committee authority enforced'],
                ],
                'sections' => [
                    [
                        'type' => 'steps',
                        'title' => 'Accreditation Pathway',
                        'description' => 'Reference process carried into Laravel routing.',
                        'items' => [
                            ['title' => 'Eligibility', 'body' => 'Active IDA Global Network member organizations in good standing may begin.'],
                            ['title' => 'Apply', 'body' => 'Submit a standards-based institutional application.'],
                            ['title' => 'Review', 'body' => 'Assigned reviewers assess evidence and process alignment.'],
                            ['title' => 'Workspace', 'body' => 'Case progress, findings, and decisions are tracked in a controlled workspace.'],
                            ['title' => 'Decision', 'body' => 'Authorized leadership records the final outcome and follow-up actions.'],
                        ],
                    ],
                ],
            ],
            'accreditation-application' => [
                'title' => 'Accreditation Application',
                'eyebrow' => 'Institutional Accreditation',
                'description' => 'The controlled intake view for accreditation applications and pre-submission readiness.',
                'metrics' => [
                    ['label' => 'Eligibility note', 'value' => 'Active members', 'detail' => 'Good-standing organizations only'],
                    ['label' => 'Required fields', 'value' => 'Tracked', 'detail' => 'Submission readiness should remain explicit'],
                    ['label' => 'Stored locally', 'value' => 'Draft capable', 'detail' => 'Reference copy uses local-device save language'],
                ],
                'sections' => [
                    [
                        'type' => 'cards',
                        'title' => 'Before You Begin',
                        'description' => 'Backend copy and flow aligned to the GN Central application guidance.',
                        'items' => [
                            ['title' => 'Confirm active membership', 'body' => 'Only active IDA Global Network member organizations in good standing are eligible.'],
                            ['title' => 'Prepare evidence', 'body' => 'Required supporting material should be assembled before formal submission.'],
                            ['title' => 'Track draft state', 'body' => 'Draft handling should remain visible to users before preparation for submission.'],
                        ],
                    ],
                ],
            ],
            'accreditation-workspace' => [
                'title' => 'Accreditation Process Workspace',
                'eyebrow' => 'Institutional Accreditation',
                'description' => 'A case-oriented workspace for evidence, reviewer findings, and decision-stage movement.',
                'metrics' => [
                    ['label' => 'Open cases', 'value' => 3, 'detail' => 'Representative accreditation workload'],
                    ['label' => 'Assigned reviewers', 'value' => 4, 'detail' => 'Controlled reviewer roster'],
                    ['label' => 'Stages active', 'value' => 3, 'detail' => 'Review, evidence, and decision'],
                ],
                'sections' => [
                    [
                        'type' => 'table',
                        'title' => 'Current Cases',
                        'description' => 'Representative case records to mirror the GN Central process view.',
                        'columns' => ['Case', 'Stage', 'Reviewer', 'Next action'],
                        'rows' => [
                            ['KWT-ACC-001', 'Evidence review', 'Assigned reviewer', 'Record findings'],
                            ['IND-ACC-002', 'Committee discussion', 'Executive reviewers', 'Prepare recommendation'],
                            ['SGP-ACC-003', 'Decision ready', 'Programme office', 'Record final outcome'],
                        ],
                    ],
                ],
            ],
            'accreditation-reviewer-training' => [
                'title' => 'Accreditation Reviewer Training',
                'eyebrow' => 'Institutional Accreditation',
                'description' => 'Reviewer onboarding, standards orientation, and evidence-handling guidance.',
                'metrics' => [
                    ['label' => 'Core modules', 'value' => 4, 'detail' => 'Orientation, evidence, scoring, decisions'],
                    ['label' => 'Completion signal', 'value' => 'Tracked', 'detail' => 'Reviewer readiness should be explicit'],
                    ['label' => 'Access model', 'value' => 'Restricted', 'detail' => 'Authorized reviewers only'],
                ],
                'sections' => [
                    [
                        'type' => 'steps',
                        'title' => 'Reviewer Path',
                        'description' => 'Core training flow taken from the GN Central reviewer-training workspace.',
                        'items' => [
                            ['title' => 'Orientation', 'body' => 'Review the accreditation purpose, standards, and decision model.'],
                            ['title' => 'Evidence handling', 'body' => 'Understand confidentiality, file control, and record expectations.'],
                            ['title' => 'Scoring and comments', 'body' => 'Apply standards consistently and document rationale clearly.'],
                            ['title' => 'Recommendation discipline', 'body' => 'Separate evidence review from final decision authority.'],
                        ],
                    ],
                ],
            ],
            'priority-queue' => [
                'title' => 'Priority Queue',
                'eyebrow' => 'Operational Worklist',
                'description' => 'A single detailed view of items requiring review, publishing decisions, or content updates.',
                'metrics' => [
                    ['label' => 'Total open items', 'value' => 10, 'detail' => 'Reference queue total'],
                    ['label' => 'Workstreams', 'value' => 3, 'detail' => 'Applications, events, and resources'],
                    ['label' => 'Ready for decision', 'value' => 5, 'detail' => 'Items in a decision-ready state'],
                ],
                'sections' => [
                    [
                        'type' => 'queue',
                        'title' => 'Queue Groups',
                        'description' => 'Priority groupings aligned to the GN Central queue page.',
                        'items' => [
                            ['title' => 'Partner Applications', 'status' => 'Review', 'body' => 'Three applications are awaiting their first assigned review.', 'details' => ['3 partner applications', 'Assign or begin the first application review', 'Application workspace, evidence, comments, and decision history'], 'route' => 'dashboard.membership-applications.index'],
                            ['title' => 'Event Submissions', 'status' => 'Ready', 'body' => 'Five submitted events require a publishing decision.', 'details' => ['5 event submissions', 'Review content, dates, permissions, and visibility', 'Authorized publishing decision'], 'route' => 'dashboard.events.index'],
                            ['title' => 'Resource Updates', 'status' => 'Pending', 'body' => 'Two updates are pending as part of the Central toolkit refresh.', 'details' => ['2 resource updates', 'Confirm content, version status, and publication readiness', 'GN Central resources and controlled materials'], 'route' => 'dashboard.resource-centre.index'],
                        ],
                    ],
                ],
            ],
            'engagement' => [
                'title' => 'Member Engagement Dashboard',
                'eyebrow' => 'Administration · Restricted',
                'description' => 'A controlled oversight view for reporting, renewal, attendance, participation, and timely support.',
                'metrics' => [
                    ['label' => 'Members in good standing', 'value' => '84%', 'detail' => '+6 points this cycle'],
                    ['label' => 'Reports received', 'value' => '17 / 21', 'detail' => 'Four follow-ups due'],
                    ['label' => 'Renewals complete', 'value' => 14, 'detail' => 'Five in progress'],
                    ['label' => 'Needs support', 'value' => 3, 'detail' => 'Human review required'],
                ],
                'sections' => [
                    [
                        'type' => 'table',
                        'title' => 'Priority Follow-Up',
                        'description' => 'Indicators are drawn from reporting, meetings, renewals, and action-plan records.',
                        'columns' => ['Member', 'Reporting', 'Attendance', 'Renewal', 'Recommended action'],
                        'rows' => [
                            ['Member organization A', 'Current', '78%', 'Complete', 'None'],
                            ['Member organization B', 'Report due', '55%', 'In progress', 'Supportive reminder'],
                            ['Member organization C', 'Overdue', '32%', 'Not started', 'Personal follow-up'],
                            ['Member organization D', 'Current', '64%', 'Payment pending', 'Payment support'],
                        ],
                    ],
                    [
                        'type' => 'notice',
                        'tone' => 'warning',
                        'title' => 'Safeguard',
                        'body' => 'No status reduction is automated. Authorized staff must verify the record, contact the organization, and follow the approved Handbook process before any membership action.',
                    ],
                ],
            ],
            'authority-levels' => [
                'title' => 'Authority Levels & User Profiles',
                'eyebrow' => 'Restricted administration',
                'description' => 'Define who can see, manage, review, decide, and administer each GN Central area.',
                'metrics' => [
                    ['label' => 'Authority levels', 'value' => 8, 'detail' => 'Least-privilege ladder in the reference model'],
                    ['label' => 'Profile groups', 'value' => 3, 'detail' => 'Leadership, committee, and operations'],
                    ['label' => 'Permission principle', 'value' => 'Least privilege', 'detail' => 'Separate visibility from decision power'],
                ],
                'sections' => [
                    [
                        'type' => 'cards',
                        'title' => 'Role Levels',
                        'description' => 'Representative levels from the GN Central authority map.',
                        'items' => [
                            ['title' => 'Level 01 · Viewer', 'body' => 'Can see approved dashboards and member-safe resources only.'],
                            ['title' => 'Level 04 · Executive Committee Reviewer', 'body' => 'Reviews assigned applications and records recommendations.'],
                            ['title' => 'Level 06 · Programme Office', 'body' => 'Coordinates workspace operations, routing, and controlled publication.'],
                            ['title' => 'Level 08 · Platform Administrator', 'body' => 'Manages technical settings and full access control.'],
                        ],
                    ],
                    [
                        'type' => 'table',
                        'title' => 'Proposed User Profiles',
                        'description' => 'Representative user-profile assignments visible in the reference workspace.',
                        'columns' => ['User', 'Role', 'Allowed', 'Denied'],
                        'rows' => [
                            ['Mr. Steve O\'Brien', 'Executive Leadership', 'Full health dashboard; committee applications; final decisions', 'Technical security settings'],
                            ['Dr. Gad Elbeheri', 'Executive Leadership', 'Comments, recommendations, approved exports', 'Unassigned confidential evidence'],
                            ['Dr. Elsa Cardenas-Hagan', 'Committee Reviewer', 'Assigned applications; internal comments; recommendations', 'Final decision alone'],
                            ['Phyllis Munyi', 'Committee Reviewer', 'Assigned applications; own organization profile', 'Other member private records'],
                        ],
                    ],
                ],
            ],
            default => [],
        };
    }
}
