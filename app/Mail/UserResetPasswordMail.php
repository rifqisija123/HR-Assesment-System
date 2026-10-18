<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  User    $user        Pengguna yang akan direset password-nya
     * @param  string  $setupUrl    Link untuk membuat password baru
     * @param  int     $expireHours Masa berlaku link (jam)
     */
    public function __construct(
        public User $user,
        public string $setupUrl,
        public int $expireHours = 24,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Permintaan Reset Password Akun Verta Assess — Buat Password Baru',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.user-reset-password',
            with: [
                'roleLabel' => match ($this->user->role) {
                    'super_admin' => 'Super Admin',
                    'hr_admin'    => 'HR Admin',
                    'reviewer'    => 'Reviewer',
                    default       => ucfirst((string) $this->user->role),
                },
            ],
        );
    }
}
