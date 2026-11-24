<?php

declare(strict_types=1);

namespace miralsoft\synaxon\api\DTO;

class AcronisEntityMetricsResponseDto extends AbstractDto
{
    /**
     * The number of local storage
     *
     * @return float
     */
    public function getLocalStorage(): float
    {
        return (float) $this->required('local_storage');
    }

    /**
     * The number of workstations
     *
     * @return float
     */
    public function getWorkstations(): float
    {
        return (float) $this->required('workstations');
    }

    /**
     * The number of servers
     *
     * @return float
     */
    public function getServers(): float
    {
        return (float) $this->required('servers');
    }

    /**
     * The number of vms
     *
     * @return float
     */
    public function getVms(): float
    {
        return (float) $this->required('vms');
    }

    /**
     * The number of m365 seats
     *
     * @return float
     */
    public function getM365Seats(): float
    {
        return (float) $this->required('m365_seats');
    }

    /**
     * The number of m365 mailboxes
     *
     * @return float
     */
    public function getM365Mailboxes(): float
    {
        return (float) $this->required('m365_mailboxes');
    }

    /**
     * The number of m365 onedrive
     *
     * @return float
     */
    public function getM365Onedrive(): float
    {
        return (float) $this->required('m365_onedrive');
    }

    /**
     * The number of m365 sharepoint sites
     *
     * @return float
     */
    public function getM365SharepointSites(): float
    {
        return (float) $this->required('m365_sharepoint_sites');
    }

    /**
     * The number of google mail
     *
     * @return float
     */
    public function getGoogleMail(): float
    {
        return (float) $this->required('google_mail');
    }

    /**
     * The number of google drive
     *
     * @return float
     */
    public function getGoogleDrive(): float
    {
        return (float) $this->required('google_drive');
    }

    /**
     * The number of google team drive
     *
     * @return float
     */
    public function getGoogleTeamDrive(): float
    {
        return (float) $this->required('google_team_drive');
    }

    /**
     * The number of m365 teams
     *
     * @return float
     */
    public function getM365Teams(): float
    {
        return (float) $this->required('m365_teams');
    }

    /**
     * The number of storage
     *
     * @return float
     */
    public function getStorage(): float
    {
        return (float) $this->required('storage');
    }

    /**
     * The number of class1 storage
     *
     * @return float
     */
    public function getClass1Storage(): float
    {
        return (float) $this->required('class1_storage');
    }

    /**
     * The number of class2 storage
     *
     * @return float
     */
    public function getClass2Storage(): float
    {
        return (float) $this->required('class2_storage');
    }

    /**
     * The number of server storage
     *
     * @return float
     */
    public function getServerStorage(): float
    {
        return (float) $this->required('server_storage');
    }

    /**
     * The number of vm storage
     *
     * @return float
     */
    public function getVmStorage(): float
    {
        return (float) $this->required('vm_storage');
    }

    /**
     * The number of workstation storage
     *
     * @return float
     */
    public function getWorkstationStorage(): float
    {
        return (float) $this->required('workstation_storage');
    }

    /**
     * The number of mailbox storage
     *
     * @return float
     */
    public function getMailboxStorage(): float
    {
        return (float) $this->required('mailbox_storage');
    }

    /**
     * The number of o365 teams storage
     *
     * @return float
     */
    public function getO365TeamsStorage(): float
    {
        return (float) $this->required('o365_teams_storage');
    }

    /**
     * The number of onedrive storage
     *
     * @return float
     */
    public function getOnedriveStorage(): float
    {
        return (float) $this->required('onedrive_storage');
    }

    /**
     * The number of nas
     *
     * @return float
     */
    public function getNas(): float
    {
        return (float) $this->required('nas');
    }

    /**
     * The number of nas storage
     *
     * @return float
     */
    public function getNasStorage(): float
    {
        return (float) $this->required('nas_storage');
    }

    /**
     * The number of storage total
     *
     * @return float
     */
    public function getStorageTotal(): float
    {
        return (float) $this->required('storage_total');
    }

    /**
     * The number of immutable storage
     *
     * @return float
     */
    public function getImmutableStorage(): float
    {
        return (float) $this->required('immutable_storage');
    }

    /**
     * The number of c2c storage
     *
     * @return float
     */
    public function getC2cStorage(): float
    {
        return (float) $this->required('c2c_storage');
    }

    /**
     * The number of pack advanced backup workstations
     *
     * @return float
     */
    public function getPackAdvBackupWorkstations(): float
    {
        return (float) $this->required('pack_adv_backup_workstations');
    }

    /**
     * The number of pack advanced backup servers
     *
     * @return float
     */
    public function getPackAdvBackupServers(): float
    {
        return (float) $this->required('pack_adv_backup_servers');
    }

    /**
     * The number of pack advanced backup vms
     *
     * @return float
     */
    public function getPackAdvBackupVms(): float
    {
        return (float) $this->required('pack_adv_backup_vms');
    }

    /**
     * The number of pack advanced management
     *
     * @return float
     */
    public function getPackAdvManagement(): float
    {
        return (float) $this->required('pack_adv_management');
    }

    /**
     * The number of pack advanced security
     *
     * @return float
     */
    public function getPackAdvSecurity(): float
    {
        return (float) $this->required('pack_adv_security');
    }

    /**
     * The number of pack advanced security mdr
     *
     * @return float
     */
    public function getPackAdvSecurityMdr(): float
    {
        return (float) $this->required('pack_adv_security_mdr');
    }

    /**
     * The number of pack advanced security without edr
     *
     * @return float
     */
    public function getPackAdvSecurityWithoutEdr(): float
    {
        return (float) $this->required('pack_adv_security_without_edr');
    }

    /**
     * The number of pack advanced security with edr
     *
     * @return float
     */
    public function getPackAdvSecurityWithEdr(): float
    {
        return (float) $this->required('pack_adv_security_with_edr');
    }

    /**
     * The number of pack advanced security edr workloads
     *
     * @return float
     */
    public function getPackAdvSecurityEdrWorkloads(): float
    {
        return (float) $this->required('pack_adv_security_edr_workloads');
    }

    /**
     * The number of pack advanced security edr workloads g1
     *
     * @return float
     */
    public function getPackAdvSecurityEdrWorkloadsG1(): float
    {
        return (float) $this->required('pack_adv_security_edr_workloads_g1');
    }

    /**
     * The number of pack advanced security m365 seats
     *
     * @return float
     */
    public function getPackAdvSecurityM365Seats(): float
    {
        return (float) $this->required('pack_adv_security_m365_seats');
    }

    /**
     * The number of pack advanced email security
     *
     * @return float
     */
    public function getPackAdvEmailSecurity(): float
    {
        return (float) $this->required('pack_adv_email_security');
    }
}
